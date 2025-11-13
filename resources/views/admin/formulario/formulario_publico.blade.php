
    <form action="{{ route('admin.formulario.guardar') }}" method="POST"  >
        @csrf
                                
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-900">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="swal2-input"
            style="width: 90%;"  required>
        </div>

        <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">

            <div>
                <label class="block text-sm font-medium text-gray-900">Apellido Paterno:</label>
                <input type="text" id="apellidoP" name="apellidoP" class="swal2-input"  required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-900">Apellido Materno:</label>
                <input type="text" id="apellidoM" name="apellidoM" class="swal2-input"  required>
        </div>    

        <button type="submit" >
            subir
        </button>

    </div>
    </form>
