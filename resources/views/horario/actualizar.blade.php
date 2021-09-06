<x-app-layout>
    <x-slot name="header">
        Actualizar horario
    </x-slot>
    @if(!empty($horario))
    <div class="container">
        <!-- Columns are always 50% wide, on mobile and desktop -->
        <div class="row">
            <div class="col-8">
                <div class="container-md d-flex justify-content-center">
                    <!-- general form elements -->
                    <div class="card card-primary container">
                        <div class="card-header">
                            <h3 class="card-title">Actualizar Horario</h3>
                        </div>
                        <!-- /.card-header -->
                        <x-toast-message></x-toast-message>
                        <!-- form start -->
                        <form method="POST" action="{{ route('horario.update.put') }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $horario->id }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputDescripcion1">Descripcion</label>
                                    <input type="text" name="descripcion" value="{{ $horario->descripcion }}" class="form-control" id="exampleInputDescripcion1" required>
                                </div>
                                <div class="form-group">
                                    <label>Hora inicio</label>
                                    <input type="time" name="hora_inicio" value="{{ $horario->hora_inicio }}" class="form-control"  required/>
                                </div>
                                <div class="form-group">
                                    <label>Hora fin</label>
                                    <input type="time" name="hora_fin" value="{{ $horario->hora_fin }}" class="form-control"  required/>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>

                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="col-4">
                <div class="container-md">
                    <form action="{{ route('horario.delete') }}" method="POST">
                        @csrf   
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{$horario->id}}">
                        <button type="submit" class="btn btn-danger">Eliminar horario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
        <x-error404></x-error404>
    @endif
</x-app-layout>