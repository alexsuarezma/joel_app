<section class="content">

    <!-- Default box -->
    <div class="row">
        <div class="col-md-12">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" wire:model="search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3" id="accordion">
            <div class="card card-primary card-outline">
                <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            Filtros especiales
                        </h4>
                    </div>
                </a>
                <div id="collapseOne" class="collapse show" data-parent="#accordion" style="">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 d-flex">
                                <div class="form-group col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sidebar" id="exampleInputCodigodProducto1" placeholder="Codigo Producto" wire:model="producto_id">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-sidebar" data-toggle="modal" data-target="#modal-selected-product">
                                                <i class="fas fa-search fa-fw"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Descripción" wire:model="producto_descripcion" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex">
                                <div class="form-group col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sidebar" id="exampleInputSectorLote" placeholder="Sector / Lote" wire:model="sector_lote_id">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-sidebar"  data-toggle="modal" data-target="#modal-selected-sector-lote">
                                                <i class="fas fa-search fa-fw"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Descripción" wire:model="sector_lote_descripcion" readonly>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex">
                                <div class="form-group col-md-2">
                                    <input type="text" class="form-control" id="exampleInputSecuencia1" placeholder="Secuencia" wire:model="secuencia">
                                </div>
                                <div class="form-group col-md-4"></div>
                                <div class="form-group col-md-2">
                                    <select class="custom-select" wire:model="anulado">
                                        <option value="0">No anulado</option>                    
                                        <option value="1">Anulado</option>
                                    </select>
                                </div>
                                <div class="col-md-2 d-flex">
                                    <input type="date"  class="form-control" id="exampleInputFechaInicio1" wire:model="fecha_inicio">
                                </div>
                                <div class="col-md-2 d-flex">
                                    <input type="date"  class="form-control" id="exampleInputFechaFin1" wire:model="fecha_fin">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <x-toast-message></x-toast-message>
        <div class="card-header">
            <h3 class="card-title">Lista de Gastos</h3>

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
                            Fecha documento
                        </th>
                        <th>
                            Sector / lote
                        </th>
                        <th>
                            Anulado
                        </th>
                        <th style="width: 8%" class="text-center">
                            Total Gasto
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($gastos as $gasto)
                        <tr>
                            <td>
                                #{{$gasto->id}}
                            </td>
                            <td>
                                <div class="d-flex justify-content-around align-items-center">
                                    <div class="">
                                        <a>
                                        {{$gasto->comentario}}
                                        </a>
                                        <br/>
                                        <small>
                                            Created {{$gasto->created_at}}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                            {{$gasto->fecha_documento}}
                            </td>
                            <td class="project_progress">
                                {{$gasto->sectorLote->descripcion}}
                            </td>
                            <td class="project_progress">
                                <span class="{{ $gasto->anulado == 1 ? 'badge badge-danger' : '' }}">{{ $gasto->anulado == 1 ? 'Anulado' : '' }}</span>
                            </td>
                            <td class="project-state">
                                <span>{{ $gasto->total_gasto }}</span>
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="{{ route('gasto.update', ['id' => $gasto->id] ) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Ver documento
                                </a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    
                    <tr>
                        <th colspan="6">
                        </th>
                    </tr>
                    <tr>
                        <th colspan="5">
                            <span class="float-right">Total gastos</span>
                        </th>
                        <th><span class="float-right">{{$total_gasto->total_gasto}}</span></th>
                    </tr>
                </tbody>
            </table>
            {{$gastos->links()}}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <div wire:ignore.self class="modal fade" id="modal-selected-product" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Selección Producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
               
                <div class="modal-body">
                    <div class="callout callout-info">
                        <h5>Selección Producto</h5>
                    </div>
                    <p>Productos</p>
                    <div class="col-md-12">
                        <div class="input-group" data-widget="sidebar-search">
                            <input class="form-control form-control-sidebar" type="search" placeholder="Search" wire:model="searchModals" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-sidebar">
                                    <i class="fas fa-search fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0" style="padding-top:40px; height: 200px;">
                        <table class="table table-head-fixed text-nowrap">
                            <tbody>
                                @forelse($productos as $product)
                                    <tr style="cursor:pointer;" wire:click.prevent="selectedProducto({{$product}})" data-bs-dismiss="modal">
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->descripcion}}</td>
                                    </tr>
                                @empty
                                    <div class="d-flex align-items-center justify-content-center pt-3">
                                        <span class="text-gray-400 text-sm">No existen coincidencias asociadas a su busqueda.</span>
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div wire:ignore.self class="modal fade" id="modal-selected-sector-lote" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Selección Sector / Lote</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
               
                <div class="modal-body">
                    <div class="callout callout-info">
                        <h5>Selección Sector / Lote</h5>
                    </div>
                    <p>Sector / Lotes</p>
                    <div class="col-md-12">
                        <div class="input-group" data-widget="sidebar-search">
                            <input class="form-control form-control-sidebar" type="search" placeholder="Search" wire:model="searchModals" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-sidebar">
                                    <i class="fas fa-search fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0" style="padding-top:40px; height: 200px;">
                        <table class="table table-head-fixed text-nowrap">
                            <tbody>
                                @forelse($sector_lotes as $sector_lote)
                                    <tr style="cursor:pointer;" wire:click.prevent="selectedSectorLote({{$sector_lote}})" data-bs-dismiss="modal">
                                        <td>{{$sector_lote->id}}</td>
                                        <td>{{$sector_lote->descripcion}}</td>
                                    </tr>
                                @empty
                                    <div class="d-flex align-items-center justify-content-center pt-3">
                                        <span class="text-gray-400 text-sm">No existen coincidencias asociadas a su busqueda.</span>
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script>
        window.livewire.on('hideModal', () => {
            $('#modal-selected-product').modal('hide') 
            $('#modal-selected-sector-lote').modal('hide') 
        })

        window.livewire.on('showError', (error) => {
            alert(error)
        })
    </script>
</section>