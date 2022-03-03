<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Documento Balance Final</title>
  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href=" {{ asset('/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/dist/css/adminlte.min.css') }}">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row mt-4">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> Papaya Maradol.
        </h2>
      </div>
      <!-- /.col -->
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Balance final año {{$anio}}</h3>
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
                                <strong>{{ '1 Ene ,'.$anio.' - '.'31 Dic ,'.$anio }}</strong>
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
                   
                </ul>
            </div>
            </div>
        </div>
    <!-- /.card-body -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>