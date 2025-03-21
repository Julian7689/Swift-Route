<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PedidoForm extends Component
{
    public $usuarios;
    public $transportistas;

    public function __construct($usuarios, $transportistas)
    {
        $this->usuarios = $usuarios;
        $this->transportistas = $transportistas;
    }
    public function render(): View|Closure|string
    {
        return view('components.pedido-form');
    }
}
