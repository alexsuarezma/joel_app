<div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="exampleInputSectorLote">Sector / Hectarea {{ $sector_lote_id != '' ? '['.$descripcion_lote.']' : '' }}</label>
            <div class="input-group">
                <input type="text" class="form-control form-control-sidebar" id="exampleInputSectorLote" name="sector_lote_id" placeholder="Sector / Hectarea" wire:model="sector_lote_id" readonly>
                <div class="input-group-append">
                    <button type="button" class="btn btn-sidebar"  data-toggle="modal" data-target="#modal-selected-sector-lote">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
            @error('sector_lote_id') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputSectorLote">Meses</label>
            <input type="text" class="form-control form-control-sidebar" id="exampleInputSectorLote" placeholder="Sector / Hectarea (Mes)" wire:model="sector_lote_mes" readonly>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <label class="font-weight-bold mt-3">Detalle</label>
    </div>
        <!-- <div class="d-flex">
            <div class="col-md-1" wire:click="agregateDetail()"><i class="fa fa-plus-circle ml-5 mt-4" aria-hidden="true" style="cursor:pointer; font-size:25px;" title="agregar"></i></div>   
        </div> -->
    <div class="row border p-3">
        <div class="form-group col-md-6">
            <label for="exampleInputCodigodProducto1">Codigo Producto {{ $producto_id != '' ? '['.$descripcion.']' : '' }}</label>
            <div class="input-group">
                <input type="text" class="form-control form-control-sidebar" id="exampleInputCodigodProducto1" value="{{$producto_id}}" placeholder="Producto" wire:model="producto_id" readonly>
                <div class="input-group-append">
                    <button type="button" class="btn btn-sidebar" data-toggle="modal" data-target="#modal-selected-product">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
            @error('producto_id') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputUnidadMedida1">Unidad Medida</label>
            <input type="text" class="form-control" id="exampleInputUnidadMedida1" wire:model.lazy="unidad_medida" onkeypress="return filterFloat(event,this)" readonly>
            @error('unidad_medida') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputFactor1">Factor</label>
            <input type="text" class="form-control" id="exampleInputFactor1" wire:model.lazy="factor" onkeypress="return filterFloat(event,this)" readonly>
            @error('factor') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputCantidad1">Cantidad</label>
            <input type="text" class="form-control" id="exampleInputCantidad1" wire:model.lazy="cantidad" onkeypress="return filterFloat(event,this)" readonly>
            @error('cantidad') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputCajas1">Cajas</label>
            <input type="text" class="form-control" id="exampleInputCajas1" wire:model.lazy="cajas" onkeypress="return filterFloat(event,this)">
            @error('cajas') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputTotal1">Total</label>
            <input type="text" class="form-control" id="exampleInputTotal1" wire:model.lazy="total" readonly>
            @error('total') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-12 mt-4">
            <button type="button" class="btn btn-success float-right" wire:click="agregateDetail()">Agregar item</button>
        </div>
        
    </div>
    <!-- <hr class="mt-1 mb-4 mr-5"> -->
    <table class="table table-bordered mt-2" id="dynamic_field">
        <thead>
            <tr>
                <th>No.</th>
                <th>Producto</th>
                <th style="width:250px;">Descripcion</th>
                <th style="width:150px;">Cantidad</th>
                <th style="width:150px;">Cajas</th>
                <th style="width:150px;">Unidad Medida</th>
                <th style="width:150px;">Factor</th>
                <th style="width:150px;">Total</th>
                <th style="width:50px;">
                
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($detalles_produccion as $detail)
                <tr>
                    <th style="width:100px;">
                        <div class="form-group">
                            {{$detail['secuencia']}}
                            <input type="hidden" name="secuencia[]" value="{{$detail['secuencia']}}" readonly>
                        </div>
                    </th>
                    <th style="width:500px;">
                        <div class="form-group">
                            {{$detail['producto_id']}}
                            <input type="hidden" name="producto_id[]" value="{{$detail['producto_id']}}" readonly required>
                        </div>
                    </th>
                    <th style="width:150px;">
                        <div class="form-group">
                            {{$detail['descripcion']}}
                        </div>
                    </th>
                    <th style="width:150px;">
                        <div class="form-group">
                            {{$detail['cantidad']}}
                            <input type="hidden" name="cantidad[]" value="{{$detail['cantidad']}}" readonly required>
                        </div>
                    </th>
                    <th style="width:150px;">
                        <div class="form-group">
                            {{$detail['cajas']}}
                            <input type="hidden" name="cajas[]" value="{{$detail['cajas']}}" readonly required>
                        </div>
                    </th>
                    <th style="width:150px;">
                        <div class="form-group">
                            {{$detail['unidad_medida']}}
                            <input type="hidden" name="unidad_medida[]" value="{{$detail['unidad_medida']}}" readonly required>
                        </div>
                    </th>
                    <th style="width:150px;">
                        <div class="form-group">
                            {{$detail['factor']}}
                            <input type="hidden" name="factor[]" value="{{$detail['factor']}}" readonly required>
                        </div>
                    </th>
                    <th style="width:150px;">
                        <div class="form-group">
                            {{$detail['total']}}
                            <input type="hidden" name="total[]" value="{{$detail['total']}}" readonly required>
                        </div>
                    </th>
                    <th style="width:50px;">
                            <div class="col-md-1">
                            <i class="fa fa-minus-circle mt-2" aria-hidden="true" style="cursor:pointer; font-size:25px;" title="eliminar" wire:click="removeDetail({{$detail['secuencia']}})"></i>
                        </div>
                    </th>
                </tr>
            @empty
            @endforelse
            <tr>
                <th colspan="8">
                </th>
            </tr>
            <tr>
                <th colspan="7">
                    <span class="float-right">Total</span>
                </th>
                <th>{{$totalDocumento}}</th>
            </tr>
        </tbody>
    </table>

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
                            <input class="form-control form-control-sidebar" type="search" placeholder="Search" wire:model="search" aria-label="Search">
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
                    <h4 class="modal-title">Selección Sector / Hectarea</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
               
                <div class="modal-body">
                    <div class="callout callout-info">
                        <h5>Selección Sector / Hectarea</h5>
                    </div>
                    <p>Sector / Hectareas</p>
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
                    <div class="card-body table-responsive p-0" style="padding-top:40px; height: 200px;">
                        <table class="table table-head-fixed text-nowrap">
                            <tbody>
                                @forelse($sector_lotes as $sector_lote)
                                    <tr style="cursor:pointer;" wire:click.prevent="selectedSectorLote({{$sector_lote}})" data-bs-dismiss="modal">
                                        <td>{{$sector_lote->id}}</td>
                                        <td>{{$sector_lote->descripcion}}</td>
                                        <td>{{$sector_lote->dualidad_mes}}</td>
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
    </script>
</div>
