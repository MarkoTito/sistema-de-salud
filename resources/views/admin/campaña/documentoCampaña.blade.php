<x-admin-layout>
    
    <div class="mb-4">
        <h2>Ingresar Lista de participantes a la campaña</h2>
    </div>

    @push('css')
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />        
    @endpush

    <div class="mb-4">
        <form action="{{ route('admin.campañas.documento.dropzone', $id) }}" 
              class="dropzone" 
              id="my-dropzone" 
              method="POST" 
              enctype="multipart/form-data">
            @csrf
        </form>

        
    </div>

    @push('js')
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
        <script>
            Dropzone.options.myDropzone = {
                    maxFiles: 3,
                    acceptedFiles: '.png,.jpg,.jpeg,.gif,.webp,.pdf',
                    dictDefaultMessage: "Arrastra los archivos al recuadro para subirla",
                    success: function(file, response) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡El documento fue subido correctamente!',
                            text: response.message
                        });
                        
                    },

                    init: function() {
                        this.on("success", function(file, response) {
                            // Espera un poquito para mostrar el mensaje y luego redirige
                            setTimeout(function() {
                                window.location.href = "{{ route('admin.Campañas.show',$id) }}";
                            }, 1500);
                        });
                    },

                    error: function(file, response) {
                        let message = response;

                        if (typeof response === "object" && response.error) {
                            message = response.error;
                        } else if (typeof response === "object") {
                            message = response.message || "Error desconocido";
                        }

                        file.previewElement.classList.add("dz-error");
                        const _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                        for (let i = 0, len = _ref.length; i < len; i++) {
                            _ref[i].textContent = message;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: '¡Ups!',
                            text: message
                        });
                    }


            };
        </script>                                
    @endpush

</x-admin-layout>