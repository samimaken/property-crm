<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuotationItem extends Model
{
    use HasFactory, SoftDeletes;

    public function unit() {
        return $this->belongsTo(PropertyUnit::class, 'property_unit_id');
    }

    public function quotation() {
        return $this->belongsTo(Quotation::class);
    }

}
