<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estrategia extends Model
{
    use HasFactory;
    protected $fillable = ['estrategia'];

    public function item(){
           
        return $this->hasOne(Item::class);
          
    }
} 