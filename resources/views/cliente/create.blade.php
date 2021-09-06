<x-app-layout>
    <x-slot name="header">
        Registrar nuevo cliente
    </x-slot>
    <div class="container-md d-flex justify-content-center">
        <!-- general form elements -->
        <div class="card card-primary container">
            <div class="card-header">
                <h3 class="card-title">Registrar Cliente</h3>
            </div>
            <!-- /.card-header -->
            <x-toast-message></x-toast-message>
            <!-- form start -->
            <form method="POST" action="{{ route('cliente.create.post') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputCedula1">Cedula</label>
                        <input type="text" name="cedula" value="{{ old('cedula') }}" class="form-control" id="exampleInputCedula1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNombres1">Nombres</label>
                        <input type="text" name="nombres" value="{{ old('nombres') }}" class="form-control" id="exampleInputNombres1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputApellidos1">Apellidos</label>
                        <input type="text" name="apellidos" value="{{ old('apellidos') }}" class="form-control" id="exampleInputApellidos1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDireccion1">Dirección</label>
                        <input type="text" name="direccion" value="{{ old('direccion') }}" class="form-control" id="exampleInputDireccion1" required>
                    </div>
                    <div class="form-group">
                        <label>Telefono</label>
                        <input type="text" name="telefono" value="{{ old('telefono') }}" class="form-control"  required/>
                    </div>
                    <div class="form-group">
                        <label>Celular</label>
                        <input type="text" name="celular" value="{{ old('celular') }}" class="form-control"  required/>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Crear Cliente</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</x-app-layout>