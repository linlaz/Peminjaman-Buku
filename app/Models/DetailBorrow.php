<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBorrow extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function borrow()
    {
        return $this->BelongsTo(Borrow::class, 'id_borrow');
    }
}
