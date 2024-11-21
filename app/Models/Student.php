<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'dni',
        'given_name',
        'family_name',
        'email',
        'bithdate',
        'state',
    ];


    protected $casts = [
        'bithdate' => 'datetime',
        'state' => 'boolean',
    ];
}
