<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup_Company extends Model
{
    use HasFactory;

    protected $table = 'setup_company';

    protected $fillable = [
        'company_name',
        //'company_code',
        'location',
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'telephone',
        'mobile',
        'website',
        'status',
        'flag'
    ];

    // SetupCompany model
    public function divisions()
    {
        return $this->hasMany(Setup_Division::class);
    }

}
