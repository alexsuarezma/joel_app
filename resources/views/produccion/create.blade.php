<x-app-layout>
    <x-slot name="header">
        Registro de Producción
    </x-slot>
    <div class="container">
        <!-- general form elements -->
        <x-toast-message></x-toast-message>
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Registro de Producción</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('produccion.create.post') }}" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputComentario1">Comentario</label>
                            <input type="text" name="comentario" value="{{ old('comentario') }}" class="form-control" id="exampleInputComentario1" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputFechaDocumento1">Fecha Documento</label>
                            <input type="date" name="fecha_documento" value="{{ old('fecha_documento') ? old('fecha_documento') : date('Y-m-d', strtotime(\Carbon\Carbon::now())) }}" class="form-control" id="exampleInputFechaDocumento1" required>
                        </div>
                    </div>
                    <livewire:produccion.detalle />   
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-success float-right">Registrar Producción</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</x-app-layout>