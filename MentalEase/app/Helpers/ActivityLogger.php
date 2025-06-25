<?php

namespace App\Helpers;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class ActivityLogger
{
    /**
     * Log an activity
     *
     * @param string $description The activity description
     * @param string $type The activity type (login, appointment, assessment, system, etc.)
     * @param string|null $icon Font Awesome icon class (without the fa- prefix)
     * @param int|null $userId The user ID (if applicable)
     * @return null
     */
    public static function log($description, $type = 'general', $icon = null, $userId = null)
    {
        // Temporarily disable activity logging until table exists
        return null;
    }

    /**
     * Get default icon for activity type
     *
     * @param string $type
     * @return string
     */
    private static function getDefaultIconForType($type)
    {
        switch ($type) {
            case 'login':
                return 'sign-in-alt';
            case 'logout':
                return 'sign-out-alt';
            case 'register':
                return 'user-plus';
            case 'appointment':
                return 'calendar-check';
            case 'assessment':
                return 'clipboard-check';
            case 'payment':
                return 'credit-card';
            case 'system':
                return 'cog';
            case 'error':
                return 'exclamation-triangle';
            case 'success':
                return 'check-circle';
            case 'warning':
                return 'exclamation-circle';
            default:
                return 'bell';
        }
    }
}
