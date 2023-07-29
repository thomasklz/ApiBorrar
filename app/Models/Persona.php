<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    
    protected $table='personas';
    public $timestamps = false;

    public $fillable = [
        'nombre',
        'direccion',
        'cedula',
        'fecha_nacimiento',
    ];
}
