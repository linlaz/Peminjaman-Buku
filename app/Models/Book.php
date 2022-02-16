<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    protected $with = ['category','author','publisher'];
    public function author()
    {
        return $this->belongsTo(Author::class, 'id_author');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'id_category');
    }
    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'id_publisher');
    }
    public function borrow()
    {
        return $this->hasMany(Borrow::class);
    }
}
