<x-app-layout>
    <x-slot name="header">
        Actualizar producto
    </x-slot>
    <div class="container">
        <!-- general form elements -->
        <x-toast-message></x-toast-message>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Actualizar Producto</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('producto.update.put') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$producto->id}}">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputDescripcion1">Descripción</label>
                        <input type="text" name="descripcion" value="{{ $producto->descripcion }}" class="form-control" id="exampleInputDescripcion1" required>
                    </div>
                    <div class="form-group">
                        <label>Tipo inventario</label>
                        <select class="form-control" name="tipo_inventario">
                          <option value="1" {{ $producto->tipo_inventario == 1 ? 'selected' : '' }}>Producto</option>
                          <option value="2" {{ $producto->tipo_inventario == 2 ? 'selected' : '' }}>Servicio</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputcosto1">Costo</label>
                        <input type="text" name="costo" value="{{ $producto->costo }}" class="form-control" id="exampleInputcosto1" onkeypress="return filterFloat(event,this)" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPrecioUnitario1">PVP</label>
                        <input type="text" name="precio_unitario" value="{{ $producto->precio_unitario }}" class="form-control" id="exampleInputPrecioUnitario1" onkeypress="return filterFloat(event,this)" required>
                    </div>
                    <div class="form-group">
                        <label>Unidad de medida</label>
                        <select class="form-control" name="unidad_medida">
                          <option value="kg" {{ $producto->unidad_medida == 'kg' ? 'selected' : '' }}>Kg</option>
                          <option value="und" {{ $producto->unidad_medida == 'und' ? 'selected' : '' }}>Und</option>
                          <option value="lb" {{ $producto->unidad_medida == 'lb' ? 'selected' : '' }}>Lb</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputGasto1">Factor</label>
                        <input type="text" name="factor" value="{{ $producto->factor }}" class="form-control" id="exampleInputGasto1" onkeypress="return filterFloat(event,this)" required>
                    </div>
                    <div class="form-group">
                        <label>Tipo de gasto</label>
                        <select class="form-control" name="tipo_gasto_id">
                            @forelse($tipo_gastos as $tipo_gasto)
                                <option value="{{$tipo_gasto->id}}" {{ $producto->tipo_gasto_id == $tipo_gasto->id ? 'selected' : '' }}>{{$tipo_gasto->descripcion}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Actualizar</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</x-app-layout>