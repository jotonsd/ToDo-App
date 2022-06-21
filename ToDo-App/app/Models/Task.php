<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
    	'user_id',
        'title',
        'description',
    	'category_id',
    	'is_pinned',
    	'is_important'
    ];

    public function category()
    {
    	return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
