<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliceRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_number',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'gender',
        'address',
        'phone',
        'identification_number',
        'description',
        'incident_details',
        'incident_date',
        'incident_location',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'incident_date' => 'date',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function phoneticCodes()
    {
        return $this->hasMany(PhoneticCode::class, 'record_id');
    }
}
