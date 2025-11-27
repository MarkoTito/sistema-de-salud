<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @can('all-salud')
                <li>
                    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <i class="fa-solid fa-heart-pulse"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Salud</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <ul id="dropdown-example" class="hidden py-2 space-y-2">
                        @can('view-campañas')
                            <li>
                                <a href="{{route('admin.Campañas.index')}}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Campañas</a>
                            </li>
                        @endcan
                        @can('view-charlas')
                            <li>
                                <a href="{{route('admin.Charlas.index')}}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Charlas</a>
                            </li>
                        @endcan
                        
                        
                    </ul>
                </li>
            @endcan
            
            <li>
                @can('all-mascota')
                    <a href="{{route('admin.Mascotas.index')}}" 
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <span class="w-6 h-6 inline-flex justefy-center intens-center" >
                            <i class="fa-solid fa-paw"></i>
                        </span>
                        <span class="ms-3">Mascotas</span>
                    </a>
                    
                @endcan
            </li>
            {{-- <li>
                <a href="{{route('admin.Configuracion.index')}}" 
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <span class="w-6 h-6 inline-flex justify-center items-center">
                        <i class="fa-solid fa-plus"></i>
                    </span>
                    <span class="ms-3">Configuración</span>
                </a>
            </li> --}}
             <li>
                <a href="{{route('admin.prueba.nada')}}" 
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <span class="w-6 h-6 inline-flex justify-center items-center">
                        <i class="fa-solid fa-plus"></i>
                    </span>
                    <span class="ms-3">Configuración</span>
                </a>
            </li>
            
        </ul>
    </div>
    </aside>