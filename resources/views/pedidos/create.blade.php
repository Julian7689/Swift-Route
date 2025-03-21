<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Pedido') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Nuevo Pedido</h3>

                    @if ($errors->any())
                        <div class="mb-4 p-3 text-red-600 bg-red-100 dark:bg-red-800 dark:text-red-200 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Se usa el componente de formulario -->
                    <x-pedido-form :usuarios="$usuarios" :transportistas="$transportistas" :action="route('pedidos.store')" />
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>