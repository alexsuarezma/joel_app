<x-app-layout>
    <x-slot name="header">
        Lista de horarios
    </x-slot>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Horarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Horarios</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="container mb-3 ">
        <div class="row">
            <div class="col-10"></div>
            <div class="col-2">
                <a href="{{ route('horario.create') }}" class="btn btn-block btn-outline-success">Crear Horario</a>
            </div>
        </div>
    </div>
    <div class="container-md d-flex justify-content-center">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Horarios</h3>
                
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <x-toast-message></x-toast-message>
                <table class="table">
                    <thead>
                        <tr>
                        <th>Descripcion</th>
                        <th>Rango horario</th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($horarios as $index => $horario)
                        <tr>
                            <td>{{$horario->descripcion}}</td>
                            <td>{{$horario->hora_inicio.' - '.$horario->hora_fin}}</td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('horario.update', ['id' => $horario->id] ) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
                {{$horarios->links()}}
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    </section>
    <!-- /.content -->
</x-app-layout>