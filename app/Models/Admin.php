<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Admin extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'admins';

    protected $fillable = [
        'username',
        'password'
    ];
}
