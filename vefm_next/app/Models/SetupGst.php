<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetupGst extends Model
{
    use HasFactory;

    protected $table = 'setup_gst';

    protected $fillable = [
        'customer_id',
        'state',
        'gst_number',
        'pan_number',
        'flag',
    ];

    public function customer()
    {
        return $this->belongsTo(Setup_Customer::class,'customer_id');
    }
}
