<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $guarded = ['id', 'is_active'];
    protected $fillable = ['name'];
}
