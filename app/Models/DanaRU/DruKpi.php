<?php

namespace App\Models\DanaRU;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DruKpi extends Model
{
    use HasFactory;

    public function template()
    {
        return $this->belongsTo(DruKpiTemplate::class, 'kpi_template_id');
    }
}
