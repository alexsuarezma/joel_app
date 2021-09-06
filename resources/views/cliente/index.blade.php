<x-app-layout>
    <x-slot name="header">
        Lista de clientes
    </x-slot>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Clientes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Clientes</li>
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
          <h3 class="card-title">Clientes</h3>

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
                          Nombres
                      </th>
                      <th style="width: 30%">
                            Email
                      </th>
                      <th>
                          Dirección
                      </th>
                      <th style="width: 8%" class="text-center">
                          Contactos
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                @forelse($clientes as $cliente)
                  <tr>
                      <td>
                          #
                      </td>
                      <td>
                          <a>
                                {{$cliente->nombres.' '.$cliente->apellidos}}
                          </a>
                          <br/>
                          {{$cliente->cedula}}
                          <br/>
                          <small>
                              Created {{$cliente->created_at}}
                          </small>
                      </td>
                      <td>
                          {{$cliente->email}}
                      </td>
                      <td class="project_progress">
                            {{$cliente->direccion}}
                      </td>
                      <td class="project-state">
                          {{$cliente->telefono.' - '.$cliente->celular}}
                      </td>
                      <td class="project-actions text-right">
                          <a class="btn btn-info btn-sm" href="{{ route('cliente.update', ['id' => $cliente->id] ) }}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Editar
                          </a>
                          <a class="btn btn-danger btn-sm" href="#">
                              <i class="fas fa-trash">
                              </i>
                              Eliminar
                          </a>
                      </td>
                  </tr>
                @empty
                @endforelse
            </tbody>
        </table>
        {{$clientes->links()}}
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
</x-app-layout>