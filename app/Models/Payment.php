<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Payment extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'student_id',
        'amount',
        'due_date',
        'payment_date',
        'is_paid',
        'payment_method'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // registra todos los campos
            ->useLogName('payment') // nombre del log
            ->logOnlyDirty() // solo guarda los campos que realmente cambiaron
            ->dontSubmitEmptyLogs(); // evita guardar logs vacíos
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
