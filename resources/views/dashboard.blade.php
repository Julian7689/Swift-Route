<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('📦 Pedidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-lg sm:rounded-lg p-6">
                
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-6">
                    📋 Lista de Pedidos
                </h3>

                <!-- Mensajes de sesión -->
                @if (session('success'))
                    <div class="mb-4 p-4 text-green-700 bg-green-100 dark:bg-green-800 dark:text-green-300 rounded-lg shadow-md">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <!-- Botones de acciones -->
                <div class="flex space-x-4 mb-6">
                    <a href="{{ route('pedidos.create') }}" class="px-5 py-2 rounded-lg bg-blue-600 text-white font-semibold shadow-md hover:bg-blue-700 transition-all">
                        ➕ Nuevo Pedido
                    </a>

                    <a href="{{ route('pedidos.pdf') }}" class="px-5 py-2 rounded-lg bg-red-600 text-white font-semibold shadow-md hover:bg-red-700 transition-all">
                        📄 Descargar PDF
                    </a>
                </div>

                @if(isset($pedidos) && $pedidos->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-md rounded-lg overflow-hidden">
                            <thead>
                                <tr class="bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                    <th class="px-6 py-3 text-left">#</th>
                                    <th class="px-6 py-3 text-left">Cliente</th>
                                    <th class="px-6 py-3 text-left">Transportista</th>
                                    <th class="px-6 py-3 text-left">Estado</th>
                                    <th class="px-6 py-3 text-left">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pedidos as $pedido)
                                    <tr class="border-t border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">
                                        <td class="px-6 py-4">{{ $pedido->id }}</td>
                                        <td class="px-6 py-4">{{ $pedido->user->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4">{{ $pedido->transportista->name ?? 'Sin asignar' }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 rounded-lg text-white font-semibold text-sm shadow-md
                                                {{ $pedido->estado === 'Entregado' ? 'bg-green-500' : 
                                                   ($pedido->estado === 'En camino' ? 'bg-yellow-500' : 'bg-red-500') }}">
                                                {{ $pedido->estado ?? 'Pendiente' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 flex space-x-3">
                                            <a href="{{ route('pedidos.edit', $pedido->id) }}" class="text-blue-500 font-semibold hover:underline">
                                                ✏️ Editar
                                            </a>
                                            <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este pedido?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 font-semibold hover:underline">
                                                    🗑️ Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-400 mt-6 text-lg">🚫 No hay pedidos disponibles.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
