@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="d-flex justify-content-between mb-2" style="margin-right: 1px; position: relative; ">
            <div class="col-xl-3 col-sm-4 " style="width: 27.5rem;">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-1 align-content-center">
                                <a href="{{ route('ventas.index') }}" class="text-decoration-none">
                                    <div class="icon text-center border-radius-md icon-sm" style="padding-right: 6px;">
                                        <i class="fas fa-arrow-left text-xs opacity-10 mt-2" aria-hidden="true"
                                            style="color: #495057; margin: 0 auto;"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="col-7">
                                <div class="numbers mt-1">
                                    <h5 class="font-weight-bolder mb-0">
                                        Detalles de la Venta
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md icon-sm">
                                    <i class="fas fa-shopping-cart text-xs opacity-10" aria-hidden="true" style="color: #ffff;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-body blur shadow-blur mx-0 mt-3 text-center d-flex align-items-center">
            <div class="row gx-4">
                <div class="col-auto my-auto">
                    <h5 class="mb-1">
                        {{ $venta->usuario->name }}
                    </h5>
                    <p class="mb-1">{{ $venta->usuario->email }}</p>
                </div>
            </div>
        </div>

        <div class="container-fluid py-4 px-0">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Información de la Venta</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="venta-id" class="form-control-label">ID de la Venta</label>
                                <p>{{ $venta->id }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="venta-fecha" class="form-control-label">Fecha</label>
                                <p>{{ $venta->fecha }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="producto-nombre" class="form-control-label">Producto</label>
                                <p>{{ $venta->producto->nombre }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="producto-descripcion" class="form-control-label">Descripción del Producto</label>
                                <p>{{ $venta->producto->descripcion }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="venta-cantidad" class="form-control-label">Cantidad</label>
                                <p>{{ $venta->cantidad }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="venta-total" class="form-control-label">Total</label>
                                <p>${{ $venta->total }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-left">
                        <a href="{{ route('ventas.edit', $venta->id) }}" class="btn bg-gradient-dark w-12 my-4 mb-2">Editar</a>
                        <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
