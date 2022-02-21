<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Documento #{{$produccion->id}}</title>
  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <!-- Font Awesome -->
  <style>
    
  </style>

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
          <small class="float-right">Date: {{$produccion->fecha_documento}}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <address>
          <!--San Francisco, CA 94107<br>
          Phone: (804) 123-5432<br>
          Email: info@almasaeedstudio.com -->
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        Para:
        <address>

        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Producción #{{$produccion->id}}</b><br>
        <br>
        <b>Fecha producción:</b> {{$produccion->created_at}}<br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>No.</th>
            <th>Producto</th>
            <th>Descripcion</th>
            <th>Tipo Gasto</th>
            <th>Cantidad</th>
            <th>Cajas</th>
            <th>Unidad Medida</th>
            <th>Factor</th>
            <th>Total</th>
          </tr>
          </thead>
          <tbody>
            @forelse($produccion->detalleProduccion as $detail)
                <tr>
                    <th>
                        <div>
                            {{$detail->secuencia}}
                        </div>
                    </th>
                    <th>
                        <div>
                            {{$detail->producto_id}}
                        </div>
                    </th>
                    <th>
                        <div>
                            {{$detail->producto->descripcion}}
                        </div>
                    </th>
                    <th>
                        <div>
                            {{$detail->producto->tipoGasto->descripcion}}
                        </div>
                    </th>
                    <th>
                        <div>
                            {{$detail->cantidad}}
                        </div>
                    </th>
                    <th>
                        <div>
                            {{$detail->cajas}}
                        </div>
                    </th>
                    <th>
                        <div>
                            {{$detail->unidad_medida}}
                        </div>
                    </th>
                    <th>
                        <div>
                            {{$detail->factor}}
                        </div>
                    </th>
                    <th>
                        <div>
                            {{$detail->total}}
                        </div>
                    </th>
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
            {{$produccion->comentario}}
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
            </tr>
            <tr>
              <th>Shipping:</th>
              <td>$5.80</td>
            </tr> -->
            <tr>
              <th>Total:</th>
              <td>{{$produccion->total_produccion}}</td>
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

</body>
</html>