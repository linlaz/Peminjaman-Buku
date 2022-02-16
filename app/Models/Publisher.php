<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function book()
    {
        return $this->hasMany(Book::class, 'id_publisher');
    }
}
