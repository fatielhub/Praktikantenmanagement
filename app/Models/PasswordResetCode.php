<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PasswordResetCode extends Model
{
    protected $fillable = [
        'email',
        'code',
        'expires_at',
        'used',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'used' => 'boolean',
    ];

    public function isValid(): bool
    {
        return !$this->used && $this->expires_at->isFuture();
    }

    public static function generateCode(string $email): string
    {
        // Delete old codes for this email
        self::where('email', $email)->delete();

        // Generate 6-digit code
        $code = str_pad((string) rand(100000, 999999), 6, '0', STR_PAD_LEFT);

        // Create new code
        self::create([
            'email' => $email,
            'code' => $code,
            'expires_at' => Carbon::now()->addMinutes(15), // Code valid for 15 minutes
            'used' => false,
        ]);

        return $code;
    }
}
