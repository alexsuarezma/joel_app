<x-app-layout>
    <x-slot name="header">
        Registrar nuevo horario
    </x-slot>
    <div class="container-md d-flex justify-content-center">
        <!-- general form elements -->
        <div class="card card-primary container">
            <div class="card-header">
                <h3 class="card-title">Registrar Horario</h3>
            </div>
            <!-- /.card-header -->
            <x-toast-message></x-toast-message>
            <!-- form start -->
            <form method="POST" action="{{ route('horario.create.post') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputDescripcion1">Descripcion</label>
                        <input type="text" name="descripcion" value="{{ old('descripcion') }}" class="form-control" id="exampleInputDescripcion1" required>
                    </div>
                    <div class="form-group">
                        <label>Hora inicio</label>
                        <input type="time" name="hora_inicio" value="{{ old('hora_inicio') }}" class="form-control"  required/>
                    </div>
                    <div class="form-group">
                        <label>Hora fin</label>
                        <input type="time" name="hora_fin" value="{{ old('hora_fin') }}" class="form-control"  required/>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</x-app-layout>