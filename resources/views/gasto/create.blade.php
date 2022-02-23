<x-app-layout>
    <x-slot name="header">
        Registro de Gastos
    </x-slot>
    <div class="container">
        <!-- general form elements -->
        <x-toast-message></x-toast-message>
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Registro de Gastos</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('gasto.create.post') }}" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputComentario1">Comentario</label>
                            <input type="text" name="comentario" value="{{ old('comentario') }}" class="form-control" id="exampleInputComentario1" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputFechaDocumento1">Fecha Documento</label>
                            <input type="date" name="fecha_documento" value="{{ old('fecha_documento') ? old('fecha_documento') : date('Y-m-d', strtotime(\Carbon\Carbon::now())) }}" class="form-control" id="exampleInputFechaDocumento1" required>
                        </div>
                    </div>
                    @if(old('producto_id'))
                        <?php 
                            $detalles_gastos = array(); 
                            $totalDocumento = 0;
                        ?>
                        @for ($i=0; $i < count(old('producto_id')) ; $i++)
                            <?php
                                array_push($detalles_gastos, 
                                    array(
                                        'secuencia' => $i + 1,
                                        'descripcion' => old('descripcion')[$i],
                                        'producto_id' => old('producto_id')[$i],
                                        'cantidad' => old('cantidad')[$i],
                                        'hectareas_aplicado' => old('hectareas_aplicado')[$i],
                                        'costo' => old('costo')[$i],
                                        'unidad_medida' => old('unidad_medida')[$i],
                                        'factor' => old('factor')[$i],
                                        'total' => old('total')[$i],
                                    )
                                );

                                $totalDocumento += old('total')[$i];

                            ?>
                        @endfor
                        
                        @livewire('gasto.detalle', [
                                                            'detalles_gastos' => $detalles_gastos,
                                                            'totalDocumento' => $totalDocumento,
                                                            'sector_lote_id' => old('sector_lote_id')
                                                        ])

                    @else
                        <livewire:gasto.detalle />   
                    @endif
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-success float-right">Registrar Gastos</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</x-app-layout>