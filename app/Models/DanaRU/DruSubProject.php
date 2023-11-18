<?php

namespace App\Models\DanaRU;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DruSubProject extends Model
{
    use HasFactory;

    public function project()
    {
        return $this->belongsTo(DruProject::class, 'project_id');
    }
}
