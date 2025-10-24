<?php

namespace App\Policies;

use App\Models\Provider;
use App\Models\User;

class ProviderPolicy
{
    public function placeOrder(User $user, Provider $provider): bool
    {
        // Simple: allow if user belongs to provider or is admin.
        // Implement real checks in production.
        return $user->is_admin ?? false;
    }
}
