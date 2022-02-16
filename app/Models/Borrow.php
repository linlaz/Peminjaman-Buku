<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['book'];
    public function book()
    {
        return $this->belongsTo(Book::class, 'id_book');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function detailborrow()
    {
        return $this->hasMany(DetailBorrow::class);
    }
}
