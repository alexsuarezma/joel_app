<x-app-layout>
    <x-slot name="header">
        Lista de empleados
    </x-slot>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Empleados</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Empleados</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Empleados</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body pb-0">
                <div class="row">
                    @forelse($empleados as $empleado)
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                    {{$empleado->admin == 1 ? 'Administrador' : 'Usuario'}}
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>{{$empleado->nombres.' '.$empleado->apellidos}}</b></h2>
                                        <p class="text-muted text-sm"><b>Acerca de: </b>  {{$empleado->cedula}} - {{$empleado->email}}, horario:{{$empleado->horario_id != null ? $empleado->horario->descripcion : ''}} </p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Dirección: {{$empleado->direccion}}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + {{$empleado->telefono}}</li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <div alt="user-avatar" class="img-circle img-fluid">
                                            <i class="fas fa-user-alt" style="font-size:60px"></i>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                    <a href="#" class="btn btn-sm bg-teal">
                                        <i class="fas fa-comments"></i>
                                    </a>
                                    <a href="{{ route('empleado.update', ['id' => $empleado->id] ) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-user"></i> View Profile
                                    </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <nav aria-label="Contacts Page Navigation">
                    {{$empleados->links()}}
                </nav>
            </div>
            <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
</x-app-layout>