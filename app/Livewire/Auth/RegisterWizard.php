<?php

namespace App\Livewire\Auth;

use App\Mail\RegistrationOtpMail;
use App\Models\RegistrationOtp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class RegisterWizard extends Component
{
    // 1 = Verify Email (sub-phases: enter email / enter code), 2 = Personal Info, 3 = Password
    public int $currentStep = 1;
    public bool $codeSent = false;

    // Step 1
    public string $email = '';
    public string $code = '';
    public ?string $verificationToken = null;
    public int $resendCooldown = 0;
    public int $attemptsRemaining = RegistrationOtp::MAX_ATTEMPTS;

    // Step 2
    public string $first_name = '';
    public string $last_name = '';
    public string $middle_initial = '';
    public string $sex = '';
    public string $birthday = '';

    // Step 3
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Real-time validation hook triggered whenever a property is updated.
     */
    public function updated($propertyName)
    {
        if ($this->currentStep === 1 && $propertyName === 'email') {
            $this->validateOnly('email', [
                'email' => ['required', 'email:rfc,dns']
            ]);
        } elseif ($this->currentStep === 2) {
            $this->validateOnly($propertyName, $this->getStep2Rules(), $this->getStep2Messages());
        } elseif ($this->currentStep === 3) {
            // Validate the password and confirmation matching in real-time
            if ($propertyName === 'password' || $propertyName === 'password_confirmation') {
                $this->validateOnly('password', $this->getStep3Rules());
            }
        }
    }

    public function sendCode(): void
    {
        $this->validateOnly('email', [
            'email' => ['required', 'email:rfc,dns'],
        ]);

        if (User::where('email', $this->email)->exists()) {
            $this->addError('email', 'This email is already registered. Try signing in instead.');
            return;
        }

        $existing = RegistrationOtp::where('email', $this->email)->first();

        if ($existing && $existing->isReservationActive()) {
            $this->addError('email', 'This email is currently completing registration in another session. Please try again later.');
            return;
        }

        if ($existing && ! $existing->isVerified()) {
            $cooldown = $existing->secondsUntilResendAllowed();
            if ($cooldown > 0) {
                $this->resendCooldown = $cooldown;
                $this->codeSent = true;
                $this->addError('code', "Please wait {$cooldown}s before requesting a new code.");
                return;
            }
        }

        $this->issueNewCode();
    }

    public function resendCode(): void
    {
        $existing = RegistrationOtp::where('email', $this->email)->first();

        if (! $existing) {
            $this->issueNewCode();
            return;
        }

        $cooldown = $existing->secondsUntilResendAllowed();
        if ($cooldown > 0) {
            $this->resendCooldown = $cooldown;
            $this->addError('code', "Please wait {$cooldown}s before requesting a new code.");
            return;
        }

        $this->issueNewCode();
    }

    protected function issueNewCode(): void
    {
        $code = RegistrationOtp::generateCode();

        try {
            Mail::to($this->email)->send(
                new RegistrationOtpMail($code, RegistrationOtp::CODE_TTL_MINUTES)
            );
        } catch (\Throwable $e) {
            $this->addError('email', 'We could not send the verification email right now. Please try again shortly.');
            return;
        }

        RegistrationOtp::updateOrCreate(
            ['email' => $this->email],
            [
                'code_hash' => Hash::make($code),
                'attempts' => 0,
                'last_sent_at' => now(),
                'code_expires_at' => now()->addMinutes(RegistrationOtp::CODE_TTL_MINUTES),
                'verified_at' => null,
                'verification_token' => null,
                'reservation_expires_at' => null,
            ]
        );

        $this->code = '';
        $this->codeSent = true;
        $this->resendCooldown = RegistrationOtp::RESEND_COOLDOWN_SECONDS;
        $this->attemptsRemaining = RegistrationOtp::MAX_ATTEMPTS;

        $this->resetErrorBag();
    }

    public function verifyCode(): void
    {
        $this->validateOnly('code', [
            'code' => ['required', 'digits:6'],
        ]);

        $record = RegistrationOtp::where('email', $this->email)->first();

        if (! $record) {
            $this->addError('code', 'Please request a verification code first.');
            $this->codeSent = false;
            return;
        }

        if ($record->isCodeExpired()) {
            $this->addError('code', 'This code has expired. Please request a new one.');
            return;
        }

        if ($record->attempts >= RegistrationOtp::MAX_ATTEMPTS) {
            $this->addError('code', 'Too many invalid attempts. Please request a new code.');
            $this->attemptsRemaining = 0;
            return;
        }

        if (! Hash::check($this->code, $record->code_hash)) {
            $record->increment('attempts');
            $this->attemptsRemaining = $record->attemptsRemaining();
            $this->addError('code', "Invalid code. {$this->attemptsRemaining} attempt(s) remaining.");
            return;
        }

        $token = Str::random(64);

        $record->update([
            'verified_at' => now(),
            'verification_token' => $token,
            'reservation_expires_at' => now()->addMinutes(RegistrationOtp::RESERVATION_TTL_MINUTES),
        ]);

        $this->verificationToken = $token;
        $this->currentStep = 2;
        $this->resetErrorBag();
    }

    // --- Validation Rules for Step 2 ---
    protected function getStep2Rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'regex:/^[A-Za-z\s]+$/'],
            'last_name' => ['required', 'string', 'regex:/^[A-Za-z\s]+$/'],
            'middle_initial' => ['nullable', 'string', 'regex:/^[A-Za-z]$/'],
            'sex' => ['required', 'in:male,female'], // Removed 'other'
            'birthday' => [
                'required',
                'date',
                // Dynamically ensure they are at least 18 and at most 100
                'before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
                'after_or_equal:' . now()->subYears(100)->format('Y-m-d'),
            ],
        ];
    }

    protected function getStep2Messages(): array
    {
        return [
            'first_name.regex' => 'First name must contain only letters and spaces.',
            'last_name.regex' => 'Last name must contain only letters and spaces.',
            'middle_initial.regex' => 'Middle initial must be a single letter.',
            'sex.required' => 'Please select an option.',
            'sex.in' => 'Invalid selection.',
            'birthday.before_or_equal' => 'You must be at least 18 years old to register.',
            'birthday.after_or_equal' => 'Maximum allowed age is 100 years.',
            'birthday.required' => 'Please provide a valid date of birth.',
        ];
    }

    public function goToPasswordStep(): void
    {
        $this->validate($this->getStep2Rules(), $this->getStep2Messages());
        $this->currentStep = 3;
    }

    public function backToStep(int $step): void
    {
        if ($step < $this->currentStep) {
            $this->currentStep = $step;
        }
    }

    // --- Validation Rules for Step 3 ---
    protected function getStep3Rules(): array
    {
        return [
            'password' => [
                'required',
                'string',
                'min:8',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/[A-Z]/', $value)) {
                        $fail('Password must contain at least 1 uppercase letter.');
                    }
                    if (!preg_match('/[0-9]/', $value)) {
                        $fail('Password must contain at least 1 number.');
                    }
                    if (!preg_match('/[\W_]/', $value)) {
                        $fail('Password must contain at least 1 special character.');
                    }
                },
                'confirmed' // Matches with password_confirmation
            ],
        ];
    }

    public function register(): void
    {
        // Strict backend validation before creation
        $this->validate($this->getStep3Rules(), [
            'password.confirmed' => 'The passwords do not match.',
            'password.min' => 'Password must be at least 8 characters long.',
        ]);

        $record = RegistrationOtp::where('email', $this->email)
            ->where('verification_token', $this->verificationToken)
            ->first();

        if (! $record || ! $record->isVerified() || ! $record->isReservationActive()) {
            $this->addError('password', 'Your email verification has expired. Please verify your email again.');
            $this->currentStep = 1;
            $this->codeSent = false;
            $this->verificationToken = null;
            return;
        }

        if (User::where('email', $this->email)->exists()) {
            $this->addError('password', 'This email was just registered. Please sign in instead.');
            return;
        }

        DB::transaction(function () use ($record) {
            $user = User::create([
                'first_name' => ucwords(strtolower($this->first_name)),
                'last_name' => ucwords(strtolower($this->last_name)),
                'middle_initial' => $this->middle_initial ? strtoupper($this->middle_initial) : null,
                'sex' => $this->sex,
                'email' => $this->email,
                'contact_no' => null,
                'birthday' => $this->birthday,
                'password' => Hash::make($this->password),
                'role' => 'Buyer',
            ]);

            $record->delete();
            Auth::login($user);
        });

        $this->redirect(route('home'), navigate: false);
    }

    public function render()
    {
        return view('livewire.auth.register-wizard');
    }
}