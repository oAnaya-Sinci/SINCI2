<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surveysClients extends Model
{
    use HasFactory;

    protected $table = "clientes_encuestas";

    public $timestamps = false;

    protected $fillable = [
        'llave_encuesta',
        'orden_compra_cliente',
        'nombre_cliente',
        'codigo_proyecto_cliente',
        'descripcion_proyecto_cliente',
        'correo_cliente',
        'correo_copia',
        'correo_copia_oculta',
        'id_encuesta',
    ];
}
