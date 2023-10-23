<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['item','estrategia_id'];

     public function estrategia(){

          return $this->belongsTo(Estrategia::class);

     }
}
