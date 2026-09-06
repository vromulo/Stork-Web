<?php

namespace App\Mail;

use App\Models\SellerApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SellerApplicationDecisionMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public SellerApplication $application,
        public string $status,
        public ?string $reason = null
    ) {}

    public function envelope(): Envelope
    {
        $subject = $this->status === 'approved'
            ? 'Storkia - Your Seller Application has been Approved!'
            : 'Storkia - Update on Your Seller Application';

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.seller-application-decision',
        );
    }
}