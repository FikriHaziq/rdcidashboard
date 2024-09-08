<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocTemplate extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function reviseContent($column, $data = [])
    {   
        // $data = ["key" => "year", "value" => "2013"]
        $content = $this[$column];
        foreach ($data as $key => $item) {
            $content = str_replace('{{'.$item['key'].'}}', $item['value'], $content);
        }
        return $content;
    }
}
