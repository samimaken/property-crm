<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use HasFactory, SoftDeletes;

    public function property() {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function  items() {
        return $this->hasMany(QuotationItem::class);
    }
}
