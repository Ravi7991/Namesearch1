<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneticCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_id',
        'field_name',
        'original_value',
        'phonetic_code',
        'phonetic_algorithm',
    ];

    public function policeRecord()
    {
        return $this->belongsTo(PoliceRecord::class, 'record_id');
    }
}
