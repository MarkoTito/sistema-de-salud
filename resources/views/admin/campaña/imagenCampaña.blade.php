<x-admin-layout>
    
    <div class="mb-4" >
        <H2>Ingresar Imagen del bien</H2>
    </div>

    @push('css')
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />        
    @endpush

    <div class="mb-4" >
        <form action="{{route('admin.campaña.dropzone',$id)}}" class="dropzone" id="my-dropzone" method="POST" enctype="multipart/form-data">
            @csrf
        </form>

    </div>


    @push('js')
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
        <script>
            Dropzone.options.myDropzone = {
            // Configuration options go here
        };
        </script>

    @endpush

</x-admin-layout>