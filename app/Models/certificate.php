<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $primaryKey = 'certificate_id';

    protected $fillable = [
        'name',
        'age',
        'address',
        'contact_number',
        'gender',
        'purpose',
        'certificate_type',
        'request_date',
        'issued_date',
        'status',
    ];
}
