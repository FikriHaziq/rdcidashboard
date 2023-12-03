<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DanaRU\DruDataAttachment;


class ApprovalApp extends Model
{
    use HasFactory;

    public function files()
    {
        return $this->hasMany(DruDataAttachment::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'c_id');
    }
}
