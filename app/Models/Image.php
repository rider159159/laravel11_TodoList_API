<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['todo_id', 'image_url'];

    // 每張圖片屬於一個待辦事項
    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }
}
