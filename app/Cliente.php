<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
  protected $table = 'Cliente';
  protected $primaryKey = 'IdCliente';  
  public $timestamps = false;
  protected $fillable = [
    'Nombre' ,
    'Apellido' ,
    'Celular',
    'Correo' ,
    'TipDocumento',
    'NumDocumento',
    'Direccion' ,
    'IdTipoCliente',
  ];

  protected $guarded = [

  ];

}
