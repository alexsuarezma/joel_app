<section class="content">
    <!-- Default box -->
    <div class="row mb-3">
        <div class="col-md-12">
            <a class="btn btn-info btn-sm float-right" href="{{ route('print.reports.balance.general.get', ['anio' => $anio] ) }}" target="_blank">
                <i class="fas fa-print"></i> Imprimir documento
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Balance final año {{$anio}}</h3>

            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                <div class="row">
                    <div class="col-12 col-sm-3">
                        <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Venta Total</span>
                            <span class="info-box-number text-center text-muted mb-0">${{$venta_total->venta}}</span>
                        </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3">
                        <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Gasto Total</span>
                            <span class="info-box-number text-center text-muted mb-0">${{$gastos_total->gastos}}</span>
                        </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3">
                        <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Producción Total</span>
                            <span class="info-box-number text-center text-muted mb-0">{{$produccion_total->produccion}}</span>
                        </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3">
                        <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Utilidad</span>
                            <span class="info-box-number text-center text-muted mb-0">${{$gastos_total->gastos > 0 ? number_format(( $venta_total->venta - $gastos_total->gastos), 2) : 0}}</span>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="div mt-2 mb-2">
                            <p class="text-center">
                                <i class="fas fa-caret-left mr-2" style="cursor:pointer;" wire:click="sumLessYear('less')"></i>
                                    <strong>{{ '1 Ene ,'.$anio.' - '.'31 Dic ,'.$anio }}</strong>
                                <i class="fas fa-caret-right ml-2" style="cursor:pointer;" wire:click="sumLessYear('sum')"></i>
                            </p>
                        </div>
                        <div class="post">
                            <table class="table table-bordered mt-2" id="dynamic_field">
                                <thead>
                                    <tr style="color: black; font-weight: bold;">
                                        <th>Ventas</th>
                                        <th>Gastos</th>
                                        <th>Producción</th>
                                        <th>Hectarea</th>
                                        <th>Mes</th>
                                        <th>Año</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($gastos_ventas_produccion as $detail)
                                        <tr>
                                            <th>${{$detail->ventas}}</th>
                                            <th>${{$detail->gastos}}</th>
                                            <th>{{$detail->produccion}}</th>
                                            <th>{{$detail->nombre_lote}}</th>
                                            <th>
                                                @if($detail->month == 1)
                                                    Enero
                                                @elseif($detail->month == 2)
                                                    Febrero
                                                @elseif($detail->month == 3)
                                                    Marzo
                                                @elseif($detail->month == 4)
                                                    Abril
                                                @elseif($detail->month == 5)
                                                    Mayo
                                                @elseif($detail->month == 6)
                                                    Junio
                                                @elseif($detail->month == 7)
                                                    Julio
                                                @elseif($detail->month == 8)
                                                    Agosto
                                                @elseif($detail->month == 9)
                                                    Septiembre
                                                @elseif($detail->month == 10)
                                                    Octubre
                                                @elseif($detail->month == 11)
                                                    Noviembre
                                                @elseif($detail->month == 12)
                                                    Diciembre
                                                @endif
                                            </th>
                                            <th>{{$detail->anio}}</th>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                <h3 class="text-primary"><i class="nav-icon fas fa-chart-pie"></i> Tablero de Analisis</h3>
                <!-- <p class="text-muted">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p> -->
                <br>
                <div class="text-muted">
                    <p class="text-sm">Papaya Maradol
                        <b class="d-block">Deveint Inc</b>
                    </p>
                    <p class="text-sm">Fecha Corte
                        <b class="d-block"><strong>{{ '01/01/'.$anio.' - '.'31/12/'.$anio }}</strong></b>
                    </p>
                </div>

                <h5 class="mt-5 text-muted">Detalles</h5>
                <div class="text-muted">
                    @forelse($ventas_promedio as $prom)
                        <p class="text-sm">Pvta {{ $prom->tipo_venta == 1 ? 'Local' : 'Exterior'}} Promedio
                            <b class="d-block">{{number_format($prom->precio_promedio,2)}}</b>
                        </p>
                        <p class="text-sm">Venta {{ $prom->tipo_venta == 1 ? 'Local' : 'Exterior'}}
                            <b class="d-block">{{number_format($prom->ventas,2)}}</b>
                        </p>
                    @empty
                        <p class="text-sm">Pvta Local Promedio
                            <b class="d-block">0</b>
                        </p>
                        <p class="text-sm">Venta Local
                            <b class="d-block">0</b>
                        </p>
                        <p class="text-sm">Pvta Exterior Promedio
                            <b class="d-block">0</b>
                        </p>
                        <p class="text-sm">Venta Exterior
                            <b class="d-block">0</b>
                        </p>
                    @endforelse
                    <p class="text-sm">Producción Promedio
                        <b class="d-block">
                            @if($produccion_total->produccion>0)
                                [{{number_format($produccion_total->produccion/12,2)}} lb]; [{{number_format(($produccion_total->produccion/12)/37,0)}} cajas]
                            @else
                                [{{number_format($produccion_total->produccion,2)}} lb]; [{{number_format($produccion_total->produccion,0)}} cajas]
                            @endif
                        </b>
                    </p>
                    <p class="text-sm">Rentabilidad
                        @if($gastos_total->gastos > 0 && $venta_total->venta > 0)
                            <b class="d-block">{{number_format( ((1-($gastos_total->gastos/$venta_total->venta))*100) ,2)}} %</b>
                        @else
                            <b class="d-block">Venta o gasto menor a 0, imposible calcular rentabilidad.</b>
                        @endif
                    </p>
                    <p class="text-sm">Costo Producir Caja
                        @if($gastos_total->gastos > 0 && $produccion_total->produccion > 0)
                            <b class="d-block">${{number_format(($gastos_total->gastos/($produccion_total->produccion/37)),2)}}</b>
                        @else
                            <b class="d-block">Producción o gasto menor a 0, imposible calcular costo.</b>
                        @endif
                    </p>
                </div>
                <ul class="list-unstyled">
                    <!-- <li>
                        <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Functional-requirements.docx</a>
                    </li>
                    <li>
                        <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> UAT.pdf</a>
                    </li>
                    <li>
                        <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i> Email-from-flatbal.mln</a>
                    </li>
                    <li>
                        <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i> Logo.png</a>
                    </li>
                    <li>
                        <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Contract-10_12_2014.docx</a>
                    </li> -->
                </ul>
                <!-- <div class="text-center mt-5 mb-3">
                    <a href="#" class="btn btn-sm btn-primary">Add files</a>
                    <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                </div> -->
            </div>
            </div>
        </div>
    <!-- /.card-body -->
    </div>
</section>