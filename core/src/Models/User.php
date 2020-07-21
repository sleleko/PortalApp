<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $fullname
 * @property string $email
 * @property string $phone
 *
 * @property-read UserRole $role
 * @property-read UserToken $tokens
 */
class User extends \Vesp\Models\User
{
    protected $fillable = ['username', 'password', 'fullname', 'email', 'phone', 'active', 'role_id'];

    /**
     * @return HasMany
     */
    public function tokens()
    {
        return $this->hasMany(UserToken::class);
    }
}
