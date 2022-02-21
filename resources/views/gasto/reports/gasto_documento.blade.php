<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Documento #{{$gasto->id}}</title>
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
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> Papaya Maradol.
          <small class="float-right">Date: {{$gasto->fecha_documento}}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            Gasto Documento #{{$gasto->id}}</br>
            Hectarea Ingreso
            <address>
                <strong>{{$gasto->sectorLote->descripcion}}</strong><br>
            </address>
        </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Gasto #{{$gasto->id}}</b><br>
        <br>
        <b>Fecha gasto:</b> {{$gasto->created_at}}<br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row mt-4">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
                <th>No.</th>
                <th>Hectarea</th>
                <th>Descripcion Hectarea</th>
                <th>Producto</th>
                <th>Descripcion</th>
                <th>Tipo Gasto</th>
                <th>Cantidad</th>
                <th>Hect. Apli.</th>
                <th>Costo</th>
                <th>Und. med.</th>
                <th>Factor</th>
                <th>Total</th>
          </tr>
          </thead>
          <tbody>
          <?php $cantidad = 0;?>
            @forelse($gasto->detalleGasto as $detail)
                <?php $cantidad += $detail->cantidad;?>
                <tr>
                    <th>{{$detail->secuencia}}</th>
                    <th>{{$detail->sector_lote_id}}</th>
                    <th>{{$detail->sectorLote->descripcion}}</th>
                    <th>{{$detail->producto_id}}</th>
                    <th>{{$detail->producto->descripcion}}</th>
                    <th>{{$detail->producto->tipoGasto->descripcion}}</th>
                    <th>{{$detail->cantidad}}</th>
                    <th>{{$detail->hectareas_aplicado}}</th>
                    <th>{{$detail->costo}}</th>
                    <th>{{$detail->unidad_medida}}</th>
                    <th>{{$detail->factor}}</th>
                    <th>{{$detail->total}}</th>
                </tr>
            @empty
            @endforelse
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row mt-4">
      <!-- accepted payments column -->
      <div class="col-6">
        <p class="lead">Comentario</p>
        <div></div>
        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
            {{$gasto->comentario}}
        </p>
      </div>
      <!-- /.col -->
      <div class="col-6">
        <p class="lead">Fecha Emisión {{date('Y-m-d', strtotime(\Carbon\Carbon::now()))}}</p>

        <div class="table-responsive">
          <table class="table float-right">
            <!-- <tr>
              <th style="width:50%">Subtotal:</th>
              <td>$250.30</td>
            </tr>
            <tr>
              <th>Tax (9.3%)</th>
              <td>$10.34</td>
            </tr>-->
            <tr>
              <th>Total:</th>
              <td>{{$gasto->total_gasto}}</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
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