<x-app-layout>
    <x-slot name="header">
        Registrar nuevo tipo de gasto
    </x-slot>
    <div class="container">
        <!-- general form elements -->
        <x-toast-message></x-toast-message>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Registrar Tipo Gasto</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('tipo.gasto.create.post') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputGasto1">Descripción</label>
                        <input type="text" name="descripcion" value="{{ old('descripcion') }}" class="form-control" id="exampleInputGasto1" required>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Crear</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</x-app-layout>