<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actuator extends Model
{
    protected $fillable = [
        'id', 'name', 'value'
    ];
}
