<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup_Unit extends Model
{
    use HasFactory;

    protected $table = 'setup_units';

    protected $fillable = [
        'company_id',
        'division_id',
        'unit',
        'flag',
    ];


    public function company()
    {
        return $this->belongsTo(Setup_Company::class, 'company_id');
    }

    public function division()
    {
        return $this->belongsTo(Setup_Division::class, 'division_id');
    }

}
