<x-admin-layout>
    
    <div class="mb-4">
        <h2>Importar Asitentes</h2>
    </div>

    <form action="{{ route('admin.campañas.excell.import.dropzone', $id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <p>Importar Asitentes</p>
        <input 
            type="file" 
            id="excel" 
            name="excel" 
            accept=".xlsx, .xls" 
            required
        >
        {{-- ya no sirve --}}

        <div class="flex justify-center mt-4" >
            <button type="submit"  class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                Subir
            </button>
        </div>
    </form>


</x-admin-layout>