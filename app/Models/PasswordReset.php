<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    protected $table = 'password_resets';
    protected $primaryKey = 'email';

    // Add the fields that you want to allow mass assignment for
    protected $fillable = [
        'email',
        'otp',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
