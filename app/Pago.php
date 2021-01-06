<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pago';
    protected $primaryKey = 'IdPago';  
    public $timestamps = false;
    protected $fillable = [
        'TipoComprobante',
        'NumComprobante',
        'Igv',
        'TotalPago',
        'FechaEmision',
        'FechaPago',
        'Estado',
        'IdReserva'
        
    ];
    protected $guarded = [

    ];
}
