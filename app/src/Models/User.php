<?php

namespace Market\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    protected $fillable = [
        'email',
        'username',
        'password',
        'issuper',
        'remember_identifier',
        'remember_token',
    ];

    protected $hidden = [
        'password'
    ];

    public function updateRememberCredentials($identifier, $token)
    {
        $this->update([
            'remember_identifier' => $identifier,
            'remember_token' => $token,
        ]);
    }

    public function removeRememberCredentials()
    {
        $this->updateRememberCredentials(null, null);
    }

    public function getAll()
    {
        return self::all();
    }
}
