<section class="content">
    <!-- Default box -->
    <div class="row">
        <div class="col-md-10">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" wire:model="search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <!-- select -->
            <div class="form-group">
                <!-- <label>Custom Select</label> -->
                <select class="custom-select" wire:model="status">
                    <option value="0">Todos</option>
                    <option value="1">Local</option>
                    <option value="2">Exterior</option>
                </select>
            </div>
        </div>
    </div>
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
                            #{{$cliente->id}}
                        </td>
                        <td>
                            <a>
                                {{$cliente->nombres.' '.$cliente->apellidos}}
                            </a>
                            <br/>
                            {{$cliente->cedula}}
                            <br/>
                            <small>
                                Tipo Cliente: {{ $cliente->tipo_cliente == 1 ? 'Local' : 'Exterior' }}
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
                            <!-- <a class="btn btn-danger btn-sm" href="#">
                                <i class="fas fa-trash">
                                </i>
                                Eliminar
                            </a> -->
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