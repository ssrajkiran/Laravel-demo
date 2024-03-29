<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup_Engineer extends Model
{
    use HasFactory;
    protected $table = 'setup_engineer';

    protected $fillable = [
        'company_id',
        'division_id',
        'unit_id',
        'region_id',
        'person_role',
        'engineer_ecode',
        'engineer_name',
        'engineer_designation',
        'email_id',
        'mobile_number',
        'doj',
        'dop',
        'experience',
        'yocc',
        'eligible_allowance',
        'perday_allowance',
        'bank_name',
        'account_number',
        'ifsc_code'
    ];

    protected $dates = [
        'doj',
        'dop',
    ];

    public function company()
    {
        return $this->belongsTo(Setup_Company::class, 'company_id');
    }

    public function division()
    {
        return $this->belongsTo(Setup_Division::class, 'division_id');
    }

    public function unit()
    {
        return $this->belongsTo(Setup_Unit::class, 'unit_id');
    }

    public function region()
    {
        return $this->belongsTo(Setup_Region::class, 'region_id');
    }
}



