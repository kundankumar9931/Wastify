<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'registration_number',
        'email',
        'phoneNo',
        'password',
        'building_type',
        'street_name',
        'role',
        'reward_points',
        'google_id',
        'otp',
        'otp_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function households()
    {
        return $this->hasMany(Household::class);
    }

    public function pickupRequests()
    {
        return $this->hasMany(PickupRequest::class);
    }

    public function smartBinRequests()
    {
        return $this->hasMany(SmartBinRequest::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function commercialWasteLogs()
    {
        return $this->hasMany(CommercialWasteLog::class);
    }

    /**
     * Override default email verification to send OTP.
     */
    public function sendEmailVerificationNotification()
    {
        if (!$this->otp || now()->greaterThan($this->otp_expires_at)) {
            $this->otp = rand(100000, 999999);
            $this->otp_expires_at = now()->addMinutes(15);
            $this->save();
        }

        \Illuminate\Support\Facades\Mail::to($this->email)->send(new \App\Mail\OtpMail($this->otp));
    }
}
