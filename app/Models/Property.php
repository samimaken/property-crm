<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;
    protected $appends = ['start_date_format', 'end_date_format'];
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y');
    }

    public function getStartDateFormatAttribute()
    {
        return Carbon::parse($this->attributes['pma_contract_start_date'])->format('d/m/Y');
    }

    public function getEndDateFormatAttribute()
    {
        return Carbon::parse($this->attributes['pma_contract_end_date'])->format('d/m/Y');
    }
}
