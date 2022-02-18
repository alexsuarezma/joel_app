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
        @if($data == 'LT')
            <div class="col-md-2">
                <!-- select -->
                <div class="form-group">
                    <!-- <label>Custom Select</label> -->
                    <select class="custom-select" wire:model="codigo_padre">
                        <option value="0">Todos</option>                    
                        @forelse($sectores as $sector)
                            <option value="{{$sector->id}}">{{$sector->descripcion}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
        @endif
        <div class="col-md-2">
            <!-- select -->
            <div class="form-group">
                <!-- <label>Custom Select</label> -->
                <select class="custom-select" wire:model="status">
                    <option value="3">Todos</option>                    
                    <option value="1">Vigente</option>
                    <option value="0">No Vigente</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card">
        <x-toast-message></x-toast-message>
        <div class="card-header">
            <h3 class="card-title">{{ Route::is('sector.update') ? 'Sector' : 'Lote' }}</h3>

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
                            Hectareas/Area
                        </th>
                        <th>
                            Tipo
                        </th>
                        <th style="width: 8%" class="text-center">
                            
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sector_lotes as $sector_lote)
                        <tr>
                            <td>
                                #{{$sector_lote->id}}
                            </td>
                            <td>
                                <div class="d-flex justify-content-around align-items-center">
                                    <div class="">
                                        <a>
                                        {{$sector_lote->descripcion}}
                                        </a>
                                        <br/>
                                        <small>
                                            Created {{$sector_lote->created_at}}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                            {{$sector_lote->hectareas_area}}
                            </td>
                            <td class="project_progress">
                                {{ $sector_lote->data == 'SC' ? 'Sector' : 'Lote' }}
                            </td>
                            <td class="project_progress">
                                <span class="{{ $sector_lote->vigencia == 0 ? 'badge badge-danger' : '' }}">{{ $sector_lote->anulado == 0 ? 'No Vigente' : '' }}</span>
                            </td>
                            @if(Route::is('lote.index'))
                                @can('lote.editar.avanzado')
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{ route('lote.update', ['id' => $sector_lote->id] ) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Editar
                                        </a>
                                    </td>
                                @endcan
                            @else
                                @can('sector.editar.avanzado')
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{ route('sector.update', ['id' => $sector_lote->id] ) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Editar
                                        </a>
                                    </td>
                                @endcan
                            @endif
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            {{$sector_lotes->links()}}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>