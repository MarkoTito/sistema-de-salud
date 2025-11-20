<x-admin-layout :breadcrumbs="[
    [
        'name'=>'Menu',
        'href' => '/',
    ],
    [
        'name'=> 'Mascotas',
        'href' => route('admin.Mascotas.index')
    ],
    [
        'name'=> 'Edit Mascota',
    ]
    ]">
    <form action="{{route('admin.Mascotas.update',$mascota->PK_Mascota)}}" method="POST" >


        <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4 mb-4 ">
    
            <div >
    
                <div class="flex justify-center" >
                    @if (!$imagen || empty($imagen->Tpath_imagenes))
                        <br>
                        <br>
                        <br>
                        <img src="https://st2.depositphotos.com/2945617/6862/v/450/depositphotos_68621493-stock-illustration-cute-dog-cartoon.jpg" height="350px" width="350px" alt="imagen de la campaña">
                    @else
                        <div class="mb-4">
                            <br>
                            <br>
                            <br>    
                            <img src="{{ asset('storage/'.$imagen->Tpath_imagenes) }}" height="550px" width="550px" alt="imagen de la mascota">
                        </div>
                    @endif
                    
                </div>
                
                <div class="flex justify-center" >
                    <button style="width: 35%" type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-base text-sm px-4 py-2.5 text-center leading-5">Editar</button>
                </div>
                
            </div>
    
            <div>
    
                
                    @csrf
                    @method('PUT')
    
                    <div class="p-6 rounded-lg border-2 border-blue-300 bg-blue-50 mb-4">
                        <p class="text-lg font-semibold text-center mb-4">Mascota</p>
                        <div class="grid gap-6 mb-4 md:grid-cols-3 mt-4 ">
                            <div>
                                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Nombre:</label>    
                                <input maxlength="33" name="masName" type="text" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " required value="{{$mascota->Tnombre_mascota}}" >
                            </div>
            
                            <div>
                                <label class="text-sm">Especie:</label>
                                <select required name="tipo" id="" style="width: 100%"  required>
                                    <option selected disabled  value="">Escoja una opción</option>
                                    <option value="Canino" {{'Canino' == $mascota->Tespecie_mascota ? 'selected' : '' }} >Canino</option>
                                    <option value="Felino" {{'Felino' == $mascota->Tespecie_mascota ? 'selected' : '' }} >Felino</option>
                                </select>
                                
                            </div>
            
                            <div>
            
                                <label class="text-sm">Raza:</label>
                                <select required name="raza" id="miSelect-raza" style="width: 100%" required >
                                    <option selected disabled  value="">Escoja una opción</option>
                                    @foreach ($razas as $raza)
                                        <option value="{{$raza->PK_Raza}}" {{$raza->Tdescripcion_raza == $mascota->Tdescripcion_raza ? 'selected' : '' }} >{{$raza->Tdescripcion_raza}}</option>
                                    @endforeach
                                </select>
                            </div>
            
                            <div>
                                <label class="text-sm">Sexo:</label>
                                <select required name="sexo" id="miSelect-raza" style="width: 100%" required >
                                    <option selected disabled  value="">Escoja una opción</option>
                                    <option value="MACHO" {{'MACHO' == $mascota->Tsexo_mascota ? 'selected' : '' }}  >MACHO</option>
                                    <option value="HEMBRA" {{'HEMBRA' == $mascota->Tsexo_mascota ? 'selected' : '' }}  >HEMBRA</option>                        
                                </select>
                            </div>
            
            
                            <div>
                                <label class="text-sm">Peligroso:</label>
                                <select required name="peligrosidad" id="miSelect-peligroso" style="width: 100%" required >
                                    <option selected disabled  value="">Escoja una opción</option>
                                    <option value="Si" {{'Si' == $mascota->Tpelirgo_mascota ? 'selected' : '' }}  >Si</option>
                                    <option value="NO" {{'NO' == $mascota->Tpelirgo_mascota ? 'selected' : '' }}  >NO</option>                        
                                </select>
                            </div>
            
                            <div>
            
                                <label class="text-sm">Antecedentes de Agresividad   :</label>
                                <select required required name="antecedentes" id="" style="width: 100%" >
                                    <option selected disabled  value="">Escoja una opción</option>
                                    <option value="Si" {{'Si' == $mascota->Tagrecividad_mascota ? 'selected' : '' }}  >Si</option>
                                    <option value="No" {{'No' == $mascota->Tagrecividad_mascota ? 'selected' : '' }}  >No</option>
                                </select>
                            </div>
            
                            <div>
                                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Color:</label>    
                                <input maxlength="55"  name="masColor" type="text" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{$mascota->Tcolor_mascota}}" required >
                            </div>
            
            
                            <div>
                                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Contiene señas:</label>    
                                <input maxlength="85" name="masSeñas" type="text" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{$mascota->Tseñas_mascota}}" required >
                            </div>
            
            
                            <div>
                                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Fecha de nacimiento:</label>    
                                <input type="date" name="fecha" max="{{date('Y-m-d')}}"  class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 "required  value="{{$mascota->DfechaNac_mascota}}" >
                            </div>
                            
                            
            
                        </div>
                        <div class="flex justify-center" >
                            <div>
                                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Identificacion:</label>    
                                <select name="identificacion" id="miSelect-identificacion" style="width: 85%" >
                                    <option selected disabled  value="">Escoja una opción</option>
                                    @foreach ($identificadores as $iden)
                                        <option value="{{$iden->PK_Identificacion}}" {{$iden->PK_Identificacion == $mascota->FK_Mascota_IdentificacionId ? 'selected' : '' }}  >{{$iden->Tnombre_identificacion}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
        
                    <div class="p-6 rounded-lg border-2 border-blue-300 bg-blue-50">
            
                        <p class="text-lg font-semibold text-center mb-4">Responsable</p>
        
                        <div class="grid gap-6 mb-4 md:grid-cols-3 mt-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Nombres:</label>    
                                <input type="text" maxlength="55" name="resName" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{$mascota->Tnombre_responsable}}"required>
                            </div>
        
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Apellido Paterno:</label>    
                                <input type="text" maxlength="55" name="resApeP" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{$mascota->TapellidoP_responsable}}"required>
                            </div>
        
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Apellido Materno:</label>    
                                <input type="text" maxlength="55" name="resApeM" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{$mascota->TapellidoM_responsable}}"required>
                            </div>
        
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Dirección:</label>    
                                <input type="text" maxlength="200" name="resDire" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{$mascota->Tdireccion_responsable}}"required>
                            </div>
        
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Celular:</label>    
                                <input type="text" maxlength="9" minlength="9" name="resCel" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{$mascota->Tcelular_responsable}}" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  required />
                            </div>
        
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">DNI:</label>    
                                <input type="text" maxlength="8"  pattern="\d{8}"  minlength="8" name="resDNI" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{$mascota->Tdni_responsable}}" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  required />
                            </div>
                            
                            
                        </div>
                        <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Correo:</label>    
                                <input type="text" maxlength="70" name="resEmail" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{$mascota->Tcorreo_responsable}}"required>
                            </div>
        
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Telefono Fijo:</label>    
                                <input type="text" maxlength="25" name="resTel" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{$mascota->Ttelefono_responsable}}"required>
                            </div>
                        </div>
                    </div>
                    
    
    
    
    
                
            </div>
            
    
    
    
    
        </div>
    </form>
    

</x-admin-layout>