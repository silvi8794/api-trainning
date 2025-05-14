<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Student extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

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

 public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // logOnly(['field1', 'field2'])
            ->useLogName('student') // opcional, para agrupar logs por tipo
            ->logOnlyDirty() // solo si cambió
            ->dontSubmitEmptyLogs();
    }
}
