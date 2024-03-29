<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup_Region extends Model
{
    use HasFactory;
    protected $table = 'setup_region';
    protected $fillable = [
        'company_id',
        'division_id',
        'unit_id',
        'region_name',
        'region_code',
        'invoice_code',
        'flag',
    ];

    public function division()
    {
        return $this->belongsTo(setup_Division::class,'division_id');
    }

    public function units()
    {
        return $this->belongsTo(setup_Unit::class,'unit_id');
    }

    public function company()
    {
        return $this->belongsTo(Setup_Company::class, 'company_id');
    }

}
