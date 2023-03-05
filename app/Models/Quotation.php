<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use HasFactory, SoftDeletes;
    protected $appends = ['formated'];

    public function property() {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function  items() {
        return $this->hasMany(QuotationItem::class);
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y');
    }

    public function getFormatedAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->isoFormat('Do MMMM Y');
    }
}
