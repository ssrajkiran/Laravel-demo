<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup_Customer extends Model
{
    use HasFactory;
    protected $table = 'setup_customer'; 

    protected $fillable = [
        'company_id',
        'contact_person_name',
        'contact_number',
        'door_flat_no_build_name',
        'city',
        'road_street_name',
        'area',
        'pincode',
        'state',
        'email_id',
        'tin_no',
        'tan_no',
        'pan_no',
        'service_tax_exemption',
        'tds_percentage',
        'customer_name',
        'flag',
    ];


}
