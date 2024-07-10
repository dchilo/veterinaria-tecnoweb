<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
        <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg ">
        <div class="card-header pb-0 pt-3 ">
            <div class="{{ Request::is('rtl') ? 'float-end' : 'float-start' }}">
                <h5 class="mt-3 mb-0">Configurador de Estilos</h5>
                <p>Revisa los estilos que tenemos.</p>
            </div>
            <div class="{{ Request::is('rtl') ? 'float-start mt-4' : 'float-end mt-4' }}">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <!-- End Toggle Button -->
        </div>
        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0">
            <!-- Sidebar Backgrounds -->
            <div>
                <h6 class="mb-0">Temas Disponibles</h6>
            </div>

            <style>
                .button-container {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    flex-wrap: wrap;
                    /* Para permitir el ajuste de contenido en varias líneas */
                }

                .category-button {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    margin: 10px;
                    cursor: pointer;
                    background-color: #283149;
                    /* Color de fondo del botón */
                    color: #fff;
                    /* Color del texto */
                    padding: 5px 10px;
                    /* Ajustar el relleno para hacer los botones más pequeños */
                    border: none;
                    border-radius: 8px;
                    transition: background-color 0.3s;
                    width: 120px;
                    /* Ancho fijo para todos los botones */
                }

                .category-button:hover {
                    background-color: #404B69;
                    border: 3px solid #283149;
                    /* Color del borde del botón al pasar el cursor */
                    /* Color de fondo del botón al pasar el ratón */
                }

                .category-button i {
                    font-size: 18px;
                    /* Tamaño del ícono */
                    margin-bottom: 5px;
                    /* Espaciado inferior entre el ícono y el texto */
                }
            </style>

            <div class="button-container">
                <div style="display: flex; justify-content: center;">
                    <a href="javascript:void(0)" class="theme-button background-color" onclick="setThemeAndStyles(0)">
                        <button class="category-button" style="background-color: #f8f9fa !important; color:#283149 !important; border: 1px solid #929292;">
                            <i class="fas fa-sun"></i>
                            Día
                        </button>
                    </a>

                    <a href="javascript:void(0)" class="theme-button background-color" onclick="setThemeAndStyles(1)">
                        <button class="category-button" style="background-color: #404B69 !important">
                            <i class="fas fa-moon"></i>
                            Noche
                        </button>
                    </a>
                </div>
                <div style="display: flex; flex-wrap: wrap; justify-content: center;">
                    <a href="javascript:void(0)" class="theme-button background-color" onclick="setThemeAndStyles(2)">
                        <button class="category-button" style="background-color: #5bc0de !important">
                            <i class="fas fa-child"></i>
                            Niño
                        </button>
                    </a>

                    <a href="javascript:void(0)" class="theme-button background-color" onclick="setThemeAndStyles(3)">
                        <button class="category-button" style="background-color: #a3b18a !important">
                            <i class="fas fa-user"></i>
                            Joven
                        </button>
                    </a>

                    <a href="javascript:void(0)" class="theme-button background-color" onclick="setThemeAndStyles(4)">
                        <button class="category-button" style="background-color: #8e9aaf !important">
                            <i class="fas fa-user-tie"></i>
                            Adulto
                        </button>
                    </a>
                </div>
            </div>


            <!-- Fontzise Aumentador y Restador -->
            <div>
                <h6 class="mb-0">Tamaño de Fuente</h6>
            </div>
            <div class="d-flex justify-content-center text-center align-items-center">
                <button class="btn bg-gradient-dark btn-sm mx-1" onclick="decreaseFontSize()">
                    <i class="fas fa-minus"></i>
                </button>
                <button class="btn bg-gradient-dark btn-sm mx-1" onclick="increaseFontSize()">
                    <i class="fas fa-plus"></i>
                </button>
            </div>






            <script>
                function changeFontSize(changeAmount) {
                    // Get all elements on the page
                    var allElements = document.querySelectorAll('*');

                    // Loop through each element and update its font size
                    allElements.forEach(function(element) {
                        var currentFontSize = parseFloat(window.getComputedStyle(element).getPropertyValue('font-size'));
                        var newFontSize = currentFontSize + changeAmount;
                        element.style.setProperty('font-size', newFontSize + 'px', 'important');
                    });
                }

                function increaseFontSize() {
                    // Increase the font size by 2 pixels (ajustar según sea necesario)
                    changeFontSize(2);
                }

                function decreaseFontSize() {
                    // Decrease the font size by 2 pixels (ajustar según sea necesario)
                    changeFontSize(-2);
                }
            </script>




        </div>
