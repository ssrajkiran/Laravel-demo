<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup_Division extends Model
{
    use HasFactory;

    protected $table = 'setup_division';

    protected $fillable = [
        'division_name',
        'division_code',
        'company_id',
        'flag'
    ];

    // Define the relationship with SetupCompany model
   // SetupDivision model
   public function company()
   {
       return $this->belongsTo(Setup_Company::class,'company_id');
   }

}
