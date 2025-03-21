<?php

namespace App\Http\Controllers;
use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transportista;
class TransportistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transportistas = Transportista::all();
        return view('transportistas.index', compact('transportistas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transportistas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|unique:transportistas,email',
        ]);

        Transportista::create($request->all());
        return redirect()->route('transportistas.index')->with('success', 'Transportista creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         return view('transportistas.show', compact('transportista'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('transportistas.edit', compact('transportista'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transportista $transportista)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|unique:transportistas,email,' . $transportista->id,
        ]);

        $transportista->update($request->all());
        return redirect()->route('transportistas.index')->with('success', 'Transportista actualizado correctamente');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transportista $transportista)
    {
        $transportista->delete();
        return redirect()->route('transportistas.index')->with('success', 'Transportista eliminado correctamente');
    }
}
