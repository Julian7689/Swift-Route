<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Transportista;
use App\Models\User;
use App\Notifications\PedidoEnviado;
use Barryvdh\DomPDF\Facade\Pdf;

class PedidoController extends Controller
{
    public function download(){
        $pedidos = Pedido::all();
        $pdf = Pdf::loadView('pedidos.pdf',compact('pedidos'));
        return $pdf->download('pedidos.pdf');
    }




    public function index()
    {
        $pedidos = Pedido::with(['user', 'transportista'])->get();
        return view('dashboard', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = User::all();
        $transportistas = Transportista::all();
        return view('pedidos.create', compact('usuarios', 'transportistas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'transportista_id' => 'nullable|exists:transportistas,id',
            'estado' => 'required|string',
            'detalle' => 'nullable|string',
            'fecha_entrega' => 'nullable|date',
        ]);

        Pedido::create($request->all());
        return redirect()->route('pedidos.index')->with('success', 'Pedido creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('pedidos.show', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pedido = Pedido::findOrFail($id);
        $usuarios = User::all();
        $transportistas = Transportista::all();

        return view('pedidos.edit', compact('pedido', 'usuarios', 'transportistas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'transportista_id' => 'nullable|exists:transportistas,id',
            'estado' => 'nullable|string',
            'detalle' => 'nullable|string',
            'fecha_entrega' => 'nullable|date',
        ]);

        $pedido->update($request->all());
        return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado correctamente.');
    }

    /**
     * Actualizar estado del pedido a "Enviado" y notificar al usuario.
     */
    public function actualizarEstado($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->estado = 'Enviado';
        $pedido->save();

        if ($pedido->user) {
            $pedido->user->notify(new PedidoEnviado($pedido));
        }

        return redirect()->back()->with('success', 'Pedido marcado como enviado y notificación enviada.');
    }
}
