@extends('layouts.user_type.guest')

@section('content')
    <section class="min-vh-100 mb-8">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 mx-3 border-radius-lg"
            style="background-image: url('{{ asset('assets/images/img_register.png') }}');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">¡Bienvenido!</h1>
                        <p class="text-lead text-white">Registrate cuanto antes para poder disfrutar de nuestros servicios de
                            automotriz de alta calidad y a un precio accesible.</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            {{-- <h5>Register with</h5> --}}
                        </div>
                        <div class="row px-xl-5 px-sm-4 px-3">


                            <div class="col-12 text-center">
                                <h5 class="mb-0 mt-3">Formulario de Registro</h5>
                                {{-- <small class="text-sm">Crea tu cuenta, es gratis.</small> --}}
                            </div>




                            <div class="card-body">
                                <form role="form text-left" method="POST" action="{{ url('/register') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Nombre" name="name"
                                            id="name" aria-label="Name" aria-describedby="name"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" placeholder="Correo" name="email"
                                            id="email" aria-label="Email" aria-describedby="email-addon"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control" placeholder="Contraseña" name="password"
                                            id="password" aria-label="Password" aria-describedby="password-addon">
                                        @error('password')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-check form-check-info text-left">
                                        <input class="form-check-input" type="checkbox" name="agreement"
                                            id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Yo acepto los <a href="javascript:;"
                                                class="text-dark font-weight-bolder">Terminos y Condiciones</a>
                                        </label>
                                        @error('agreement')
                                            <p class="text-danger text-xs mt-2"> Primero debes aceptar los términos y
                                                condiciones.</p>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="submit"
                                            class="btn bg-gradient-dark w-100 my-4 mb-2">Regeistrarse</button>
                                    </div>
                                    <p class="text-sm mt-3 mb-0 text-center">¿Ya tienes una cuenta? <a
                                            href="{{ url('login') }}" class="text-dark font-weight-bolder">Inicia
                                            Sesión</a></p>
                                </form>
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
                    /* Cambiado de left a right */
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
@endsection
