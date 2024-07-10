<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Paginas</a></li>
                <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                    {{ str_replace('-', ' ', Request::path()) }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize">{{ str_replace('-', ' ', Request::path()) }}</h6>
        </nav>
        <div class="mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
            <div class="ms-md-3 pe-md-3 d-flex align-items-center position-relative">
                <div id="resultContainer" class="position-relative">
                    <div class="spinner-border text-primary position-absolute top-50 start-50 translate-middle d-none"
                        role="status" hidden>
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                    <!-- Agrega el atributo hidden para ocultar resultList inicialmente -->
                    <ul id="resultList" class="list-group list-group-flush position-absolute top-100 start-0 w-100 mt-1"
                        hidden></ul>
                </div>

                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" id="searchInput" class="form-control" placeholder="Escribe aquí..."
                        value="">
                </div>
            </div>

            <ul class="navbar-nav justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">{{ auth()->user()->name }}</span>
                    </a>
                </li>
                <li class="nav-item d-flex align-items-center" style="margin-left: 12px">
                    <a href="{{ url('/logout') }}" class="nav-link text-body font-weight-bold px-0">
                        <i class="fas fa-door-open me-sm-1"></i>
                    </a>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <style>
        /* Estilos adicionales para mejorar la apariencia */
        #resultList {
            height: 200px !important;
            width: 200px !important;
            margin-top: 1.5rem !important;
            /* Ajusta la posición según tus necesidades */
            /* Ajusta la altura máxima según tus necesidades */
            overflow-y: auto !important;
            z-index: 1000 !important;
        }

        #resultList li {
            padding: 8px !important;
            cursor: pointer !important;
        }

        #resultList li:hover {
            background-color: #f8f9fa !important;
        }

        #resultContainer {
            position: relative !important;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('assets/js/dark-mode-handler.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const spinner = document.querySelector('.spinner-border');
        const resultContainer = document.getElementById('resultContainer');
        let allResults = [];

        async function fetchData() {
            var usuarioAutenticadoId = {{ auth()->check() ? auth()->user()->id : null }};
            console.log(usuarioAutenticadoId);
            try {
                spinner.classList.remove('d-none');
                const response = await fetch('/inf513/grupo07sc/proyecto2/public/api/paginas/' + usuarioAutenticadoId);
                const result = await response.json();
                allResults = result;
                console.log(allResults);
                // No muestra la lista al cargar la página
            } catch (error) {
                console.error('Error en la conexión a la API:', error);
            } finally {
                if (spinner) {
                    spinner.classList.add('d-none');
                }
            }
        }

        function displayResults(data) {
            const resultList = document.getElementById('resultList');
            resultList.innerHTML = '';

            data.forEach(page => {
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item';

                // Crear un elemento 'a' para redireccionar
                const linkItem = document.createElement('a');
                linkItem.href = `${window.location.origin}${page.link_redireccion}`;
                linkItem.innerHTML = `<p id="descp" class="text-sm mb-0">${page.descripcion}</p>`;

                // Agregar el elemento 'a' dentro del elemento 'li'
                listItem.appendChild(linkItem);

                // Agregar evento de clic al elemento 'li' para redireccionar
                listItem.addEventListener('click', () => {
                    window.location.href = linkItem.href;
                });

                resultList.appendChild(listItem);
            });

            // Quitar el atributo hidden para mostrar la lista
            resultList.removeAttribute('hidden');
        }

        function filterResults() {
            const searchInput = document.getElementById('searchInput');
            const searchTerm = searchInput.value.trim().toLowerCase();

            if (searchTerm === '') {
                // Agregar el atributo hidden para ocultar la lista
                document.getElementById('resultList').setAttribute('hidden', true);
                return;
            }

            const searchTermsArray = searchTerm.split(' ');

            const filteredResults = allResults.filter(page =>
                searchTermsArray.every(term =>
                    page.nombre_pagina.toLowerCase().includes(term) ||
                    page.descripcion.toLowerCase().includes(term)
                )
            );

            console.log('Resultados filtrados:', filteredResults);

            displayResults(filteredResults.slice(0, 8));
        }

        document.getElementById('searchInput').addEventListener('input', filterResults);

        document.addEventListener('click', function(event) {
            const isClickInsideInput = document.getElementById('searchInput').contains(event.target);
            const isClickInsideResults = document.getElementById('resultContainer').contains(event.target);

            if (!isClickInsideInput && !isClickInsideResults) {
                // Agregar el atributo hidden para ocultar la lista
                document.getElementById('resultList').setAttribute('hidden', true);
            }
        });

        fetchData();
    </script>
</nav>
<!-- End Navbar -->
