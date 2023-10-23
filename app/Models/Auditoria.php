<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    use HasFactory;
    protected $fillable = ["pregunta", "estrategia", "cargo", "servicio", "respuesta", "observacion", "auditoria","estrategia_id", "fecha"];
}
