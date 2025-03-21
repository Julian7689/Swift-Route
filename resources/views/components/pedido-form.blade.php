<div class="max-w-3xl mx-auto mt-10 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Crear Pedido</h1>

    @props(['pedido' => null, 'usuarios', 'transportistas', 'action', 'method' => 'POST'])

    <form action="{{ $action }}" method="POST" class="space-y-4">
        @csrf
        @method($method)

        <!-- Usuario -->
        <div>
            <label for="user_id" class="block font-medium text-gray-700 dark:text-gray-300">Usuario:</label>
            <select name="user_id" required 
                class="w-full mt-1 p-2 border rounded-md bg-gray-100 dark:bg-gray-700 dark:text-white">
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" 
                        {{ $pedido && $pedido->user_id == $usuario->id ? 'selected' : '' }}>
                        {{ $usuario->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Transportista -->
        <div>
            <label for="transportista_id" class="block font-medium text-gray-700 dark:text-gray-300">Transportista:</label>
            <select name="transportista_id" 
                class="w-full mt-1 p-2 border rounded-md bg-gray-100 dark:bg-gray-700 dark:text-white">
                <option value="">Sin asignar</option>
                @foreach ($transportistas as $transportista)
                    <option value="{{ $transportista->id }}" 
                        {{ $pedido && $pedido->transportista_id == $transportista->id ? 'selected' : '' }}>
                        {{ $transportista->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Estado -->
        <div>
            <label for="estado" class="block font-medium text-gray-700 dark:text-gray-300">Estado:</label>
            <input type="text" name="estado" value="{{ $pedido->estado ?? '' }}" required
                class="w-full mt-1 p-2 border rounded-md bg-gray-100 dark:bg-gray-700 dark:text-white">
        </div>

        <!-- Dirección de Envío -->
        <div>
            <label for="direccion_envio" class="block font-medium text-gray-700 dark:text-gray-300">Dirección de Envío:</label>
            <input type="text" name="direccion_envio" value="{{ $pedido->direccion_envio ?? '' }}" required
                class="w-full mt-1 p-2 border rounded-md bg-gray-100 dark:bg-gray-700 dark:text-white">
        </div>

        <!-- Detalle -->
        <div>
            <label for="detalle" class="block font-medium text-gray-700 dark:text-gray-300">Detalle:</label>
            <textarea name="detalle" 
                class="w-full mt-1 p-2 border rounded-md bg-gray-100 dark:bg-gray-700 dark:text-white">{{ $pedido->detalle ?? '' }}</textarea>
        </div>

        <!-- Fecha de entrega -->
        <div>
            <label for="fecha_entrega" class="block font-medium text-gray-700 dark:text-gray-300">Fecha de entrega:</label>
            <input type="date" name="fecha_entrega" value="{{ $pedido->fecha_entrega ?? '' }}"
                class="w-full mt-1 p-2 border rounded-md bg-gray-100 dark:bg-gray-700 dark:text-white">
        </div>

        <!-- Botón de envío -->
        <div class="flex justify-end">
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition">
                {{ $pedido ? 'Actualizar Pedido' : 'Crear Pedido' }}
            </button>
        </div>
    </form>
</div>