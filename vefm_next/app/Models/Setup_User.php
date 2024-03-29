<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup_User extends Model
{
    use HasFactory;
    protected $table = 'setup_user';
    protected $fillable = [
        'personrole',
        'division_id',
        'unit_id',
        'region_id',
        'user_id',
        'password',
        'hash_password',
        'name',
        'status',
        'designation',
        'email_id',
        'mobile_number',
        'status',
        'flag',
    ];

      public function division()
    {
        return $this->belongsTo(Setup_Division::class,'division_id');
    }

    public function unit()
    {
        return $this->belongsTo(Setup_Unit::class,'unit_id');
    }

    public function region()
    {
        return $this->belongsTo(Setup_Region::class,'region_id');
    }

}
