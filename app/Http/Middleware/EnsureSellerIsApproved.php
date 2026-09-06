<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Blocks access to seller-only areas (product management, etc.) unless the
 * seller has been approved. Approval status is derived from the existence
 * of a seller_profiles row — that table only ever holds approved sellers,
 * so "row exists" and "approved" are equivalent by design.
 *
 * This does not check the user's role; it assumes it runs after the
 * standard 'auth' middleware and only on seller-scoped routes.
 */
class EnsureSellerIsApproved
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || $user->role !== 'Seller') {
            abort(403);
        }

        if (! $user->sellerProfile) {
            return redirect()
                ->route('seller.seller-dashboard')
                ->with('error', 'Your seller application must be approved before you can access this page.');
        }

        return $next($request);
    }
}
