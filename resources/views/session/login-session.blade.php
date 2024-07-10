@extends('layouts.user_type.guest')

@section('content')
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">Bienvenido de nuevo</h3>
                                    <p class="mb-0">Crea una nueva cuenta<br></p>
                                    <p class="mb-0">O inicia sesión con tus credenciales</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{ url('/session') }}">
                                        @csrf
                                        <label>Correo</label>
                                        <div class="mb-3">
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Email" value="{{ old('email') }}" aria-label="Email"
                                                aria-describedby="email-addon">
                                            @error('email')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <label>Contraseña</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Contraseña" value="{{ old('password') }}" aria-label="Password"
                                                aria-describedby="password-addon">
                                            @error('password')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                            <label class="form-check-label" for="rememberMe">Recuerdame</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Iniciar
                                                sesión</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        No tienes una cuenta?
                                        <a href="register" class="text-info text-gradient font-weight-bold">Regístrate</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6">
                                    <img src="{{ asset('assets/images/img_login.jpg') }}" alt="Imagen Mecánico Automotriz"
                                        class="img-fluid" style="height: 100%; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                #contador {
                    position: fixed;
                    bottom: 10px;
                    right: 10px;
                    font-size: 14px;
                    opacity: 0.8;
                }

                #contador .card {
                    background-color: rgba(255, 255, 255, 0.8);
                    border: none;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
            </style>

            <!-- CONTADOR DE PAGINA LOGIN -->
            <div id="contador">
                <div class="card">
                    <div class="card-body p-2">
                        <h6 class="card-title m-0">Contador de visitas</h6>
                        <p class="card-text m-0">Esta página ha sido visitada <span
                                class="badge bg-primary">{{ $pagina->contador }}</span> veces</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
