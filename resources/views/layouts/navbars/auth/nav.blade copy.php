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
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
            {{-- <div class="nav-item d-flex align-self-end">
                <a href="https://www.creative-tim.com/product/soft-ui-dashboard-laravel" target="_blank" class="btn btn-primary active mb-0 text-white" role="button" aria-pressed="true">
                    Download
                </a>
            </div> --}}
            <div class="ms-md-3 pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" id="searchInput" class="form-control" onkeydown="handleKeyPress(event)"
                        oninput="handleChange()" placeholder="Escribe aquí...">
                </div>


            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="{{ url('/logout') }}" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">Sair</span>
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
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer"></i>
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                        aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">New message</span> from Laur
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            13 minutes ago
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <img src="../assets/img/small-logos/logo-spotify.svg"
                                            class="avatar avatar-sm bg-gradient-dark  me-3 ">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">New album</span> by Travis Scott
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            1 day
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>credit-card</title>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF"
                                                    fill-rule="nonzero">
                                                    <g transform="translate(1716.000000, 291.000000)">
                                                        <g transform="translate(453.000000, 454.000000)">
                                                            <path class="color-background"
                                                                d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                                                opacity="0.593633743"></path>
                                                            <path class="color-background"
                                                                d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            Payment successfully completed
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            2 days
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item d-flex align-items-center" style="margin-top: 0.6em; margin-left: 0.5em">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="theme-switch" style="margin-top: 0.2em">
                        <label class="form-check-label" for="theme-switch">
                            <span id="theme-indicator" class="fa"></span>
                        </label>
                    </div>
                </li>



            </ul>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <script>
        const themeSwitch = document.getElementById("theme-switch");
        const themeIndicator = document.getElementById("theme-indicator");
        const page = document.body;

        const themeStates = ["light", "dark"];
        const indicators = ["fa-moon", "fa-sun"];
        const pageClass = ["bg-gray-100", "dark-page"];

        let currentTheme = localStorage.getItem("theme");

        function setTheme(theme) {
            localStorage.setItem("theme", themeStates[theme]);
        }

        function setNormalText() {
            // Restaura el color original de todos los elementos en el cuerpo, incluyendo navbar y sidebar
            const allTextElements = document.querySelectorAll('*');
            allTextElements.forEach(element => {
                element.style.color = ''; // Deja que los estilos originales se apliquen
            });

            // Restaura el color original de los iconos
            const iconElements = document.querySelectorAll('.nav-link .icon i');
            iconElements.forEach(element => {
                element.style.color = '#1d365d'; // Cambia esto al color original de tus iconos
            });
            // Aplica la clase text-white solo a los iconos de Font Awesome
            const fontAwesomeIcons = document.querySelectorAll('td .fas');
            fontAwesomeIcons.forEach(icon => {
                icon.classList.add('text-secondary');
                icon.classList.remove('text-white');

            });

            // Restaura el color original de los íconos de los elementos no activos
            const inactiveIconElements = document.querySelectorAll('.nav-item:not(.active) .icon i');
            inactiveIconElements.forEach(element => {
                element.style.color = '#1d365d'; // Cambia esto al color original de tus íconos
            });
            console.log('setNormalText()');
        }

        function setWhiteText() {
            // Restaura el color original de todos los elementos en el cuerpo, incluyendo navbar y sidebar
            const allTextElements = document.querySelectorAll('*');
            allTextElements.forEach(element => {
                element.style.color = '#fff';
            });

            // Restaura el color original de los iconos dentro de .nav-item.active .icon i
            const navIconElements = document.querySelectorAll('.nav-item.active .icon i');
            navIconElements.forEach(element => {
                element.style.color = '#fff'; // Cambia esto al color original de tus íconos en modo oscuro
            });

            // Restaura el color original de los iconos
            const iconElements = document.querySelectorAll('.nav-link .icon i');
            iconElements.forEach(element => {
                element.style.color = '#1d365d'; // Cambia esto al color original de tus iconos
            });

            // Aplica la clase text-white solo a los iconos de Font Awesome dentro de las celdas de la tabla
            const tableIconElements = document.querySelectorAll('td .fas');
            tableIconElements.forEach(icon => {
                icon.classList.add('text-white');
                icon.classList.remove('text-secondary');
            });

            // Restaura el color original de las fechas dentro de las celdas de la tabla
            const tableDateElements = document.querySelectorAll('td span.text-secondary');
            tableDateElements.forEach(element => {
                element.style.color = '#fff'; // Cambia esto al color original de tus fechas en modo oscuro
            });

            // Restaura el color original de los enlaces de las páginas
            const pageLinkElements = document.querySelectorAll('.page-link');
            pageLinkElements.forEach(element => {
                element.style.color = ''; // Deja que los estilos originales se apliquen
            });
        }


        function setIndicator(theme) {
            if (themeIndicator) {
                themeIndicator.classList.remove(indicators[0]);
                themeIndicator.classList.remove(indicators[1]);
                themeIndicator.classList.add(indicators[theme]);
            }
        }

        function setPage(theme) {
            page.classList.remove(pageClass[0]);
            page.classList.remove(pageClass[1]);
            page.classList.add(pageClass[theme]);
        }

        function isNight() {
            const now = new Date();
            const hours = now.getHours();
            const isNight = hours < 6 || hours >= 18;
            console.log(`Current time: ${hours}h, isNight: ${isNight}`);
            return isNight;
        }

        if (currentTheme == null || currentTheme == undefined) {
            if (isNight()) {
                setTheme(1);
                setIndicator(1);
                setPage(1);
                setWhiteText();
            } else {
                setTheme(0);
                setIndicator(0);
                setPage(0);
                setNormalText();
            }
            currentTheme = localStorage.getItem("theme");
            console.log(`Initial theme set: ${currentTheme}`);
        }


        setIndicator(currentTheme);
        setPage(currentTheme);

        themeSwitch.checked = currentTheme === themeStates[0];

        themeSwitch.addEventListener('change', function() {
            if (this.checked) {
                setTheme(0);
                setIndicator(0);
                setPage(0);
                setNormalText();
            } else {
                setTheme(1);
                setIndicator(1);
                setPage(1);
                setWhiteText();
            }
            updateThemeIndicator();
        });

        function updateThemeIndicator() {
            const themeIndicatorElement = document.getElementById('theme-indicator');
            if (themeSwitch.checked) {
                themeIndicatorElement.innerHTML = '<i class="fa fa-sun"></i>';
            } else {
                themeIndicatorElement.innerHTML = '<i class="fa fa-moon"></i>';
            }
        }

        // Llama a la función para establecer el color al cargar la página
        if (currentTheme === themeStates[1]) {
            setTheme(1);
            setIndicator(1);
            setPage(1);
            setWhiteText();
        } else {
            setTheme(0);
            setIndicator(0);
            setPage(0);
            setNormalText();
        }
    </script>

    <style>
        .highlight {
            background-color: yellow;
            /* Puedes personalizar el color de fondo del resaltado */
        }
    </style>

    <script>
        let originalContent = null;

        function storeOriginalContent() {
            if (originalContent === null) {
                const body = document.body;
                originalContent = body.innerHTML;
            }
        }

        function clickEventListener(event) {
            const searchInput = document.getElementById('searchInput');
            if (!searchInput.contains(event.target) && event.target.tagName.toLowerCase() !== 'a') {
                clearHighlight();
            }
            event.stopPropagation();
        }



        document.addEventListener('click', clickEventListener);

        function handleKeyPress(event) {
            if (event.key === 'Enter') {
                search();
                event.preventDefault();
            }
        }

        function handleChange() {
            clearHighlight();
        }

        function search() {

            

            const searchTerm = document.getElementById('searchInput').value.trim();

            if (searchTerm === '') {
                clearHighlight();
                return;
            }

            if (originalContent === null) {
                storeOriginalContent();
            }

            const textNodes = getTextNodes(document.body);

            textNodes.forEach(textNode => {


                const textContent = textNode.nodeValue.trim();
                const index = textContent.toLowerCase().indexOf(searchTerm.toLowerCase());

                if (index !== -1) {
                    const before = document.createTextNode(textContent.substring(0, index));
                    const matched = document.createTextNode(textContent.substring(index, index + searchTerm
                        .length));
                    const after = document.createTextNode(textContent.substring(index + searchTerm.length));

                    const highlighted = document.createElement('span');
                    highlighted.className = 'highlight';
                    highlighted.appendChild(matched);

                    const parent = textNode.parentNode;
                    parent.replaceChild(after, textNode);
                    parent.insertBefore(after, parent.firstChild);
                    parent.insertBefore(highlighted, after);
                    parent.insertBefore(before, highlighted);
                }
            });

            document.addEventListener('click', clickEventListener);
            event.stopPropagation();
        }

        function clearHighlight() {
            const highlightedElements = document.querySelectorAll('.highlight');
            highlightedElements.forEach(element => {
                const parent = element.parentNode;
                parent.replaceChild(document.createTextNode(element.textContent), element);
            });

            document.removeEventListener('click', clickEventListener, true);
            event.stopPropagation();
            // Después de completar la búsqueda
            themeSwitch.addEventListener('change', handleThemeChange);
            F
            restoreOriginalContent();
        }

        function getTextNodes(node) {
            const textNodes = [];
            if (node.nodeType === Node.TEXT_NODE && node.nodeValue.trim() !== '') {
                textNodes.push(node);
            } else {
                const childNodes = node.childNodes;
                for (let i = 0; i < childNodes.length; i++) {
                    textNodes.push(...getTextNodes(childNodes[i]));
                }
            }
            return textNodes;
        }


        function restoreOriginalContent() {
            if (originalContent != null) {
                const body = document.body;
                body.innerHTML = originalContent;

                // Vuelve a vincular los eventos y funciones necesarios después de restaurar el contenido
                const searchInput = document.getElementById('searchInput');
                searchInput.addEventListener('keydown', handleKeyPress);
                searchInput.addEventListener('input', handleChange);

                // Agrega otros eventos y funciones según sea necesario

                originalContent = null;
            }
        }
    </script>





    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</nav>
<!-- End Navbar -->
