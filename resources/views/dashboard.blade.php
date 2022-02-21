<x-app-layout>
    {{--<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css">
    <link rel="stylesheet" href="{{ asset('/plugins/daterangepicker/daterangepicker.css') }}">
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Bienvenido al dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-bill"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Gastos {{$month}}</span>
                <span class="info-box-number">
                  {{$gastos->gastos}}
                  <small>$</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-hard-hat"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Producción {{$month}}</span>
                <span class="info-box-number">{{$produccion->produccion}} lb</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Ventas {{$month}}</span>
                <span class="info-box-number">{{$venta->venta}} <small>$</small></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Empleados</span>
                <span class="info-box-number">{{$empleados->empleados}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Reporte Analisis Anual</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div> -->
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <p class="text-center">
                      <strong>{{ '1 Ene ,'.date('Y', strtotime(\Carbon\Carbon::now())).' - '.'31 Dic ,'.date('Y', strtotime(\Carbon\Carbon::now())) }}</strong>
                    </p>

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-{{ $venta_total->venta > $gastos_total->gastos ? 'success' : ( $venta_total->venta == $gastos_total->gasto ? 'warning' : 'danger' ) }}">
                        <!-- <i class="fas fa-caret-up"></i> 17% -->
                        @if($venta_total->venta > $gastos_total->gastos)
                          <i class="fas fa-caret-up"></i>
                        @elseif($venta_total->venta == $gastos_total->gastos)
                          <i class="fas fa-caret-left"></i>
                        @else
                          <i class="fas fa-caret-down"></i>
                        @endif
                        @if($gastos_total->gastos > 0) 
                          {{ number_format(( $venta_total->venta / $gastos_total->gastos) * 100, 2) }}%
                        @else
                          0% 
                        @endif
                      </span>
                      <h5 class="description-header">${{$venta_total->venta}}</h5>
                      <span class="description-text">TOTAL VENTA</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-{{ $gastos_total->gastos > $venta_total->venta  ? 'danger' : ( $venta_total->venta == $gastos_total->gasto ? 'warning' : 'success' ) }}">
                        <!-- <i class="fas fa-caret-left"></i> 0%-->
                        @if($gastos_total->gastos > $venta_total->venta)
                          <i class="fas fa-caret-up"></i>
                        @elseif($venta_total->venta == $gastos_total->gastos)
                          <i class="fas fa-caret-left"></i>
                        @else
                          <i class="fas fa-caret-down"></i> 
                        @endif
                        
                        @if($gastos_total->gastos > 0) 
                          {{ number_format(( ($gastos_total->gastos - $venta_total->venta) / $gastos_total->gastos ) * 100, 2) }}%
                        @else
                          0% 
                        @endif 
                      </span> 
                      <h5 class="description-header">${{$gastos_total->gastos}}</h5>
                      <span class="description-text">TOTAL GASTOS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-{{ $produccion_total->produccion > 0  ? 'success' : 'warning' }}">
                        <!-- <i class="fas fa-caret-up"></i> 20% -->
                        @if($produccion_total->produccion > 0)
                          <i class="fas fa-caret-up"></i>
                        @else
                          <i class="fas fa-caret-left"></i>
                        @endif 
                      </span>
                      <h5 class="description-header">{{$produccion_total->produccion}} lb</h5>
                      <span class="description-text">TOTAL PRODUCCIÓN</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <!-- <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                      <h5 class="description-header">1200</h5>
                      <span class="description-text">GOAL COMPLETIONS</span>
                    </div>
                  </div> -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <livewire:dashboard.calendar />    

          <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-tag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Inventory</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Productos (Venta)</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Descripcion</th>
                    <th>Medida</th>
                    <th>Stock</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse($productos as $producto)
                      <tr>
                        <td>{{$producto->id}}</td>
                        <td>
                          <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                          {{$producto->descripcion}}
                        </td>
                        <td>
                          {{$producto->unidad_medida}}
                        </td>
                        <td>
                          {{$producto->stock}}
                        </td>
                      </tr>
                    @empty
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/locales-all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer type="text/javascript">
       // Get context with jQuery - using jQuery's .get() method.
      var salesChartCanvas = document.getElementById('salesChart').getContext('2d') //$('#salesChart').get(0).getContext('2d')

      var salesChartData = {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        datasets: [
          {
            label: 'Gastos',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            // pointRadius: false,
            pointColor: '#3b8bba',
            // pointStrokeColor: 'rgba(60,141,188,1)',
            // pointHighlightFill: '#fff',
            // pointHighlightStroke: 'rgba(60,141,188,1)',
            fill: false,
            tension: 0.1,
            data: @json($datos_gastos)
          },
          {
            label: 'Ventas',
            backgroundColor: 'rgba(210, 214, 222, 1)',
            borderColor: 'rgba(210, 214, 222, 1)',
            // pointRadius: false,
            pointColor: 'rgba(210, 214, 222, 1)',
            // pointStrokeColor: '#c1c7d1',
            // pointHighlightFill: '#fff',
            // pointHighlightStroke: 'rgba(220,220,220,1)',
            fill: false,
            tension: 0.1,
            data: @json($datos_ventas)
          }
        ]
      }

      var salesChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
          display: false
        },
        // scales: {
        //   xAxes: [{
        //     gridLines: {
        //       display: false
        //     }
        //   }],
        //   yAxes: [{
        //     gridLines: {
        //       display: false
        //     }
        //   }]
        // }
      }

      // This will get the first returned node in the jQuery collection.
      // eslint-disable-next-line no-unused-vars
      var salesChart = new Chart(salesChartCanvas, {
          type: 'line',
          data: salesChartData,
          options: salesChartOptions
        }
      )

      // document.addEventListener('DOMContentLoaded', function() {
      //   var calendarEl = document.getElementById('calendar');
      //   var calendar = new FullCalendar.Calendar(calendarEl, {
      //     initialView: 'monthGridMonth'
      //   });
      //   calendar.render();
      // });
    </script>
</x-app-layout>
