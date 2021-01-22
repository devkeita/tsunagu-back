<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'uid',
        'name',
        'picture_url',
    ];

    public function groups()
    {
        return $this
            ->belongsToMany(Group::class, 'user_group')
            ->using(UserGroup::class)
            ->withPivot([
                'status',
            ])
            ->withTimestamps()
        ;
    }

    public function createdGroups()
    {
        return $this->hasMany(Group::class);
    }
}
