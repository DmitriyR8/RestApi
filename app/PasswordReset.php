<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'token',
    ];

    /**
     * @param string $email
     * @param string $hashPassword
     * @return PasswordReset
     */
    public function createResetPassword(string $email, string $hashPassword): PasswordReset
    {
        return $this->create([
            'email' => $email,
            'token' => $hashPassword
        ]);
    }

    /**
     * @param string $email
     * @return bool
     */
    public function deleteByEmail(string $email): bool
    {
        return $this->where('email', $email)->delete();
    }

    /**
     * @param string $email
     * @return object
     */
    public function getByEmail(string $email): object
    {
        return $this->where('email', $email)->first();
    }
}
