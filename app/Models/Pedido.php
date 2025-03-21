<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['user_id', 'transportista_id', 'estado', 'direccion_envio', 'fecha_entrega'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function transportista()
    {
        return $this->belongsTo(Transportista::class);
    }
}