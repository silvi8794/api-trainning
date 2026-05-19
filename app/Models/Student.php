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
        'birthdate',
        'state',
    ];


    protected $casts = [
        'birthdate' => 'datetime',
        'state' => 'boolean',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function isUpToDate(): bool
    {
        return $this->payments()
            ->whereMonth('payment_date', now()->month)
            ->whereYear('payment_date', now()->year)
            ->where('is_paid', true)
            ->exists();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // logOnly(['field1', 'field2'])
            ->useLogName('student') // opcional, para agrupar logs por tipo
            ->logOnlyDirty() // solo si cambió
            ->dontSubmitEmptyLogs();
    }
}
