<?php

namespace App\Models\DanaRU;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class DruDataAttachment extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
}
