<x-app-layout>
    <x-slot name="header">
        Registrar nuevo cobro a cliente
    </x-slot>
    <div class="container-md d-flex justify-content-center">
        <!-- general form elements -->
        <div class="card card-primary container">
            <div class="card-header">
                <h3 class="card-title">Registrar Cobro a Cliente</h3>
            </div>
            <!-- /.card-header -->
            <x-toast-message></x-toast-message>
            <!-- form start -->
            <form method="POST" action="{{ route('cobro.create') }}">
                @csrf
                <div class="card-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="selection" for="exampleInputHorario1">Cobro Aplicado a Cliente</label>
                            <select class="form-control" name="cliente_id" id="exampleInputHorario1">
                                @if(!empty($clientes)) <option disabled selected>Escoja un cliente</option> @endif
                                @forelse($clientes as $cliente)
                                    <option value="{{$cliente->id}}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }} >{{ucwords($cliente->nombres.' '.$cliente->apellidos)}}</option>
                                @empty
                                    <option disabled selected>No existen clientes</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDescripcion1">Descripcion</label>
                            <textarea name="descripcion" value="{{ old('descripcion') }}" class="form-control" id="exampleInputDescripcion1" required cols="5" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputValor1">Valor</label>
                            <input type="text" name="coste" value="{{ old('coste') }}" class="form-control" id="exampleInputValor1" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFecha1">Fecha</label>
                            <input type="date" name="fecha" value="{{ old('fecha') }}" class="form-control" id="exampleInputFecha1" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDireccion1">Dirección</label>
                            <input type="text" name="direccion" value="{{ old('direccion') }}" class="form-control" id="exampleInputDireccion1" required>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Registrar Cobro</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</x-app-layout>