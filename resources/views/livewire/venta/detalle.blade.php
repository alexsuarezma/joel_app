<div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="exampleInputCliente">Cliente {{ $cliente_id != '' ? '['.$descripcion_cliente.']' : '' }}</label>
            <div class="input-group">
                <input type="text" class="form-control form-control-sidebar" id="exampleInputCliente" value="{{ old('cliente_id') }}" name="cliente_id" placeholder="Cliente" wire:model="cliente_id" readonly required>
                <div class="input-group-append">
                    <button type="button" class="btn btn-sidebar"  data-toggle="modal" data-target="#modal-selected-cliente">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
            @error('cliente_id') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="tipo_venta">Tipo Venta</label>
            <select class="custom-select" id="tipo_venta" name="tipo_venta" wire:model="tipo_venta" required>
                <option value="1" {{ old('tipo_venta') == 1 ? 'selected' : '' }}>Local</option>
                <option value="2" {{ old('tipo_venta') == 2 ? 'selected' : '' }}>Extranjero</option>
            </select>
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
            <label for="exampleInputPeso1">Cajas</label>
            <input type="text" class="form-control" id="exampleInputPeso1" wire:model.lazy="cajas" onkeypress="return filterFloat(event,this)" readonly>
            @error('cajas') <span class="error">{{ $message }}</span> @enderror
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
            <label for="exampleInputStockActual1">Stock Actual</label>
            <input type="text" class="form-control" id="exampleInputStockActual1" wire:model.lazy="stock_actual" readonly>
            @error('stock_actual') <span class="error">{{ $message }}</span> @enderror
            @if($messageError != '') <span class="error" style="color:red">{{ $messageError }}</span> @endif
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputPrecioUnitario1">Precio Unitario</label>
            <input type="text" class="form-control" id="exampleInputPrecioUnitario1" wire:model.lazy="precio_unitario" onkeypress="return filterFloat(event,this)">
            @error('precio_unitario') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputCantidad1">Cantidad</label>
            <input type="text" class="form-control" id="exampleInputCantidad1" wire:model.lazy="cantidad" onkeypress="return filterFloat(event,this)">
            @error('cantidad') <span class="error">{{ $message }}</span> @enderror
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
                <th style="width:150px;">Precio Unitario</th>
                <th style="width:150px;">Cajas</th>
                <th style="width:150px;">Unidad Medida</th>
                <th style="width:150px;">Factor</th>
                <th style="width:150px;">Total</th>
                <th style="width:50px;">
                
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($detalles_ventas as $detail)
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
                            <input type="hidden" name="descripcion[]" value="{{$detail['descripcion']}}" readonly required>
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
                            {{$detail['precio_unitario']}}
                            <input type="hidden" name="precio_unitario[]" value="{{$detail['precio_unitario']}}" readonly required>
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
                <th colspan="9">
                </th>
            </tr>
            <tr>
                <th colspan="8">
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
                                        <td>Stock Actual: {{$product->stock}}</td>
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
    <div wire:ignore.self class="modal fade" id="modal-selected-cliente" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Selección Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
               
                <div class="modal-body">
                    <div class="callout callout-info">
                        <h5>Selección Cliente</h5>
                    </div>
                    <p>Clientes</p>
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
                                @forelse($clientes as $cliente)
                                    <tr style="cursor:pointer;" wire:click.prevent="selectedCliente({{$cliente}})" data-bs-dismiss="modal">
                                        <td>{{$cliente->id}}</td>
                                        <td>{{$cliente->cedula}}</td>
                                        <td>{{$cliente->nombres.' '.$cliente->apellidos}}</td>
                                        <td>{{$cliente->tipo_cliente == 2 ? 'Extranjero' : 'Local'}}</td>
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
            $('#modal-selected-cliente').modal('hide') 
        })
    </script>
</div>
