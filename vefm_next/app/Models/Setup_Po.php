<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup_Po extends Model
{
    use HasFactory;
    protected $table = 'setup_po';

    protected $fillable = [
        'division_id',
        'unit_id',
        'region_id',
        'customer_id',
        'project_site',
        'po_number',
        'po_date',
        'po_value',
        'consumed',
        'balance',
        'flag',
    ];


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

    public function customer()
    {
        return $this->belongsTo(Setup_Customer::class, 'customer_id');
    }

}
