<section class="content">

    <!-- Default box -->
    <div class="row">
        <div class="col-md-8">
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
                <select class="custom-select" wire:model="tipo_gasto_id">
                    <option value="0">Todos</option>                    
                    @forelse($tipo_gastos as $tipo_gasto)
                        <option value="{{$tipo_gasto->id}}">{{$tipo_gasto->descripcion}}</option>
                    @empty
                    @endforelse
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <!-- select -->
            <div class="form-group">
                <!-- <label>Custom Select</label> -->
                <select class="custom-select" wire:model="tipo_inventario">
                    <option value="0">Todos</option>                    
                    <option value="1">Producto</option>
                    <option value="2">Servicio</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card">
        <x-toast-message></x-toast-message>
        <div class="card-header">
            <h3 class="card-title">Productos</h3>

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
                            Descripcion
                        </th>
                        <th style="width: 30%">
                            Costo
                        </th>
                        <th>
                            Tipo Inventario
                        </th>
                        <th style="width: 8%" class="text-center">
                            Tipo Gasto
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($productos as $producto)
                        <tr>
                            <td>
                                #{{$producto->id}}
                            </td>
                            <td>
                                <div class="d-flex justify-content-around align-items-center">
                                    <div class="">
                                        <a>
                                        {{$producto->descripcion}}
                                        </a>
                                        <br/>
                                        <small>
                                            Created {{$producto->created_at}}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                            {{$producto->costo}}
                            </td>
                            <td class="project_progress">
                                {{ $producto->tipo_inventario == 1 ? 'Producto' : 'Servicio' }}
                            </td>
                            <td class="project-state">
                                <span>{{ $producto->tipoGasto->descripcion }}</span>
                            </td>
                            @can('producto.editar.avanzado')
                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="{{ route('producto.update', ['id' => $producto->id] ) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Editar
                                    </a>
                                </td>
                            @endcan
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            {{$productos->links()}}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>