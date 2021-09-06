<x-app-layout>
    <x-slot name="header">
        Lista de cobros
    </x-slot>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cobros</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Cobros</li>
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
                  <a href="{{ route('cobro.create') }}" class="btn btn-block btn-outline-success">Registrar cobro</a>
              </div>
          </div>
      </div>
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Cobros</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 20%">
                            Descripción
                        </th>
                        <th style="width: 30%">
                              Fecha emision
                        </th>
                        <th>
                            Dirección
                        </th>
                        <th style="width: 8%" class="text-center">
                            Valor
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                  @forelse($cobros as $index => $cobro)
                    <tr>
                        <td>
                            #{{$index+1}}
                        </td>
                        <td>
                            <a>
                                  {{$cobro->descripcion}}
                            </a>
                        </td>
                        <td>
                            {{$cobro->fecha}}
                        </td>
                        <td class="project_progress">
                              {{$cobro->direccion}}
                        </td>
                        <td class="project-state">
                            {{$cobro->coste}}
                        </td>
                        <td class="project-actions text-right">
                          <a href="#modal-cobro-{{$cobro->id}}" data-toggle="modal" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        </td>
                        <div class="modal fade" id="modal-cobro-{{$cobro->id}}">
                          <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                  <div class="modal-header">
                                  <h4 class="modal-title">Registro de cobros a cliente {{$cobro->cliente->nombres.' '.$cobro->cliente->apellidos}}</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                                  </div>
                                  <div class="modal-body">
                                      <div class="card-body">
                                          <div class="form-group">
                                              <label for="exampleInputDescripcion1">Descripcion</label>
                                              <textarea disabled class="form-control" id="exampleInputDescripcion1" cols="5" rows="5">{{ $cobro->descripcion }}</textarea>
                                          </div>
                                          <div class="form-group">
                                              <label for="exampleInputValor1">Valor</label>
                                              <input type="text" disabled value="{{ $cobro->coste }}" class="form-control" id="exampleInputValor1">
                                          </div>
                                          <div class="form-group">
                                              <label for="exampleInputFecha1">Fecha</label>
                                              <input type="date" disabled value="{{ $cobro->fecha }}" class="form-control" id="exampleInputFecha1">
                                          </div>
                                          <div class="form-group">
                                              <label for="exampleInputDireccion1">Dirección</label>
                                              <input type="text" disabled value="{{ $cobro->direccion }}" class="form-control" id="exampleInputDireccion1">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                  </div>
                              </div>
                              <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                      </div>
                    </tr>
                  @empty
                  @endforelse
              </tbody>
          </table>
          {{$cobros->links()}}
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</x-app-layout>