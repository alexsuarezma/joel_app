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
    </div>
    <div class="card">
        <x-toast-message></x-toast-message>
        <div class="card-header">
            <h3 class="card-title">Tipo Gastos</h3>

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
                        <th style="width: 8%" class="text-center">
                            Creado
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                @forelse($tipo_gastos as $tipo_gasto)
                    <tr>
                        <td>
                            #{{$tipo_gasto->id}}
                        </td>
                        <td>
                            <div class="d-flex justify-content-around align-items-center">
                                <a>
                                {{$tipo_gasto->descripcion}}
                                </a>
                            </div>
                        </td>
                        <td>
                            Created {{$tipo_gasto->created_at}}
                        </td>
                        @can('tipo.gasto.editar.avanzado')
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="{{ route('tipo.gasto.update', ['id' => $tipo_gasto->id] ) }}">
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
        {{$tipo_gastos->links()}}
        </div>
        <!-- /.card-body -->
    </div>
</section>