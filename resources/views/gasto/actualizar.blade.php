<x-app-layout>
    <x-slot name="header">
        Gasto #{{$gasto->id}}
    </x-slot>
    <div class="container">
        <!-- general form elements -->
        <x-toast-message></x-toast-message>
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-info btn-sm float-right" href="{{ route('gasto.print.document.get', ['id' => $gasto->id] ) }}" target="_blank">
                    <i class="fas fa-print"></i> Imprimir documento
                </a>
            </div>
        </div>
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">Información del Registro de Gasto #{{$gasto->id}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
                <div class="card-body">
                    @if($gasto->anulado == 1)
                        <div class="row">
                            <span class="badge badge-danger p-2 float-right">Documento Anulado</span>
                        </div>
                    @endif
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputComentario1">Comentario</label>
                            <input type="text" name="comentario" value="{{ $gasto->comentario }}" class="form-control" id="exampleInputComentario1" required readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputFechaDocumento1">Fecha Documento</label>
                            <input type="text" name="fecha_documento" value="{{ $gasto->fecha_documento }}" class="form-control" id="exampleInputFechaDocumento1" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputComentario1">Hectarea</label>
                            <input type="text" name="comentario" value="{{ $gasto->sectorLote->descripcion }}" class="form-control" id="exampleInputComentario1" required readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputSectorLote">Meses</label>
                            <input type="text" class="form-control form-control-sidebar" id="exampleInputSectorLote" placeholder="Sector / Hectarea (Mes)" value="{{$gasto->sectorLote->dualidad_mes}}" readonly>
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
                                <th style="width:100px;">Hectarea</th>
                                <th style="width:100px;">Descripcion Hectarea</th>
                                <th>Producto</th>
                                <th style="width:250px;">Descripcion</th>
                                <th style="width:250px;">Tipo Gasto</th>
                                <th style="width:150px;">Cantidad</th>
                                <th style="width:150px;">Hect. Apli.</th>
                                <th style="width:150px;">Costo</th>
                                <th style="width:150px;">Und. med.</th>
                                <th style="width:150px;">Factor</th>
                                <th style="width:150px;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $cantidad = 0;?>
                            @forelse($gasto->detalleGasto as $detail)
                                <?php $cantidad += $detail->cantidad;?>
                                <tr>
                                    <th style="width:100px;">
                                        <div class="form-group">
                                            {{$detail->secuencia}}
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            {{$detail->sector_lote_id}}
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            {{$detail->sectorLote->descripcion}}
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
                                            {{$detail->producto->tipoGasto->descripcion}}
                                        </div>
                                    </th>
                                    <th style="width:150px;">
                                        <div class="form-group">
                                            {{$detail->cantidad}}
                                        </div>
                                    </th>
                                    <th style="width:150px;">
                                        <div class="form-group">
                                            {{$detail->hectareas_aplicado}}
                                        </div>
                                    </th>
                                    <th style="width:150px;">
                                        <div class="form-group">
                                            {{$detail->costo}}
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
                                <th colspan="11">
                                </th>
                            </tr>
                            <tr>
                                <th colspan="6">
                                    <span class="float-right">Cant. tot.</span>
                                </th>
                                <th>{{$cantidad}}</th>
                                <th colspan="4">
                                    <span class="float-right">Total</span>
                                </th>
                                <th>{{$gasto->total_gasto}}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if($gasto->anulado == 0)
                    @can('gasto.eliminar')
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#modal-anular-gasto">Anular Gasto</button>
                        </div>
                    @endcan
                @endif
            </form>
        </div>
        <!-- /.card -->
    </div>
    @if($gasto->anulado == 0)
        @can('gasto.eliminar')
            <div class="modal fade" id="modal-anular-gasto" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Anulación de Gasto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <form method="POST" action="{{ route('gasto.anular.put') }}" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$gasto->id}}">
                        <div class="modal-body">
                            <div class="callout callout-danger">
                                <h5>Anular el Gasto #{{$gasto->id}}</h5>
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
                        <button type="submit" class="btn btn-danger">Anular Gasto</button>
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