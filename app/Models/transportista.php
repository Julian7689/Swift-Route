<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transportista extends Model
{
    protected $fillable = ['nombre', 'telefono'];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}