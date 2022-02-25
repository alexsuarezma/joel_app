<x-app-layout>
    <x-slot name="header">
        Venta #{{$venta->id}}
    </x-slot>
    <div class="container">
        <!-- general form elements -->
        <x-toast-message></x-toast-message>
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-info btn-sm float-right" href="{{ route('venta.print.document.get', ['id' => $venta->id] ) }}" target="_blank">
                    <i class="fas fa-print"></i> Imprimir documento
                </a>
            </div>
        </div>
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">Información del Registro de Venta #{{$venta->id}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
                <div class="card-body">
                    @if($venta->anulado == 1)
                        <div class="row">
                            <span class="badge badge-danger p-2 float-right">Documento Anulado</span>
                        </div>
                    @endif
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputComentario1">Comentario</label>
                            <input type="text" name="comentario" value="{{ $venta->comentario }}" class="form-control" id="exampleInputComentario1" required readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputFechaDocumento1">Fecha Documento</label>
                            <input type="text" name="fecha_documento" value="{{ $venta->fecha_documento }}" class="form-control" id="exampleInputFechaDocumento1" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputCliente">Cliente </label>
                            <input type="text" name="comentario" value="{{ $venta->cliente->nombres.' '.$venta->cliente->apellidos }}" class="form-control" id="exampleInputComentario1" required readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tipo_venta">Tipo Venta</label>
                            <input type="text" name="comentario" value="{{ $venta->tipo_venta == 1 ? 'Local' : 'Exterior' }}" class="form-control" id="exampleInputComentario1" required readonly>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <label class="font-weight-bold mt-3">Detalle</label>
                    </div>
                    <!-- <hr class="mt-1 mb-4 mr-5"> -->
                    <table class="table table-bordered mt-2" id="dynamic_field">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Id Producto</th>
                                <th style="width:250px;">Descripcion</th>
                                <th style="width:150px;">Cantidad</th>
                                <th style="width:150px;">Precio Unitario</th>
                                <th style="width:150px;">Cajas</th>
                                <th style="width:150px;">Unidad Medida</th>
                                <th style="width:150px;">Factor</th>
                                <th style="width:150px;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($venta->detalleVenta as $detail)
                                <tr>
                                    <th style="width:100px;">
                                        <div class="form-group">
                                            {{$detail->secuencia}}
                                        </div>
                                    </th>
                                    <th style="width:500px;">
                                        <div class="form-group">
                                            {{$detail->producto_id}}
                                        </div>
                                    </th>
                                    <th style="width:500px;">
                                        <div class="form-group">
                                            {{$detail->producto->descripcion}}
                                        </div>
                                    </th>
                                    <th style="width:150px;">
                                        <div class="form-group">
                                            {{$detail->cantidad}}
                                        </div>
                                    </th>
                                    <th style="width:150px;">
                                        <div class="form-group">
                                            {{$detail->precio_unitario}}
                                        </div>
                                    </th>
                                    <th style="width:150px;">
                                        <div class="form-group">
                                            {{number_format($detail->cajas,0)}}
                                        </div>
                                    </th>
                                    <th style="width:150px;">
                                        <div class="form-group">
                                            {{$detail->unidad_medida}}
                                        </div>
                                    </th>
                                    <th style="width:150px;">
                                        <div class="form-group">
                                            {{$detail->factor}}
                                        </div>
                                    </th>
                                    <th style="width:150px;">
                                        <div class="form-group">
                                            {{$detail->total}}
                                        </div>
                                    </th>
                                </tr>
                            @empty
                            @endforelse
                            <tr>
                                <th colspan="8">
                                </th>
                            </tr>
                            <tr>
                                <th colspan="8">
                                    <span class="float-right">Total</span>
                                </th>
                                <th>{{$venta->total_venta}}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if($venta->anulado == 0)
                    @can('venta.eliminar')
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#modal-anular-venta">Anular Venta</button>
                        </div>
                    @endcan
                @endif
            </form>
        </div>
        <!-- /.card -->
    </div>
    @if($venta->anulado == 0)
        @can('venta.eliminar')
            <div class="modal fade" id="modal-anular-venta" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Anulación de Venta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <form method="POST" action="{{ route('venta.anular.put') }}" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$venta->id}}">
                        <div class="modal-body">
                            <div class="callout callout-danger">
                                <h5>Anular la Venta #{{$venta->id}}</h5>
                                <p>Estas apunto de anular este documento de gasto, lo que significa que este documento no se tomara en cuenta y no se contabilizara en tu total de gasto de tus reportes.</p>
                            </div>
                            <div class="form-group col-md-12 mt-2 mb-2">
                                <label for="examplecomentario_anulacion1">Comentario de anulación</label>
                                <textarea class="form-control" name="comentario_anulacion" id="examplecomentario_anulacion1" rows="2" required></textarea>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Por favor, escribe tu contraseña para confirmar" required>
                        </div>
                        <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Anular Venta</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        @endcan
    @endif
</x-app-layout>