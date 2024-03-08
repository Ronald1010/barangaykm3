<?php

// app\Models\Resident.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $primaryKey = 'resident_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'birthdate',
        'gender',
        'civil_status',
        'occupation',
        'contact_number',
        'email_address',
        'national_id_number',
        'passport_number',
        'barangay_id',
    ];
}
