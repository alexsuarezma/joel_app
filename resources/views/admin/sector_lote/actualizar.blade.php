<x-app-layout>
    <x-slot name="header">
        Actualizar {{ Route::is('sector.update') ? 'Sector' : 'Lote' }}
    </x-slot>
    <div class="container">
        <!-- general form elements -->
        <x-toast-message></x-toast-message>
        <div class="row mb-3 mt-3">
            <div class="col-md-12">
                @if($sector_lote->vigencia == 1)
                    <form method="POST" action="{{ Route::is('sector.update') ? route('sector.update.vigencia.put') : route('lote.update.vigencia.put') }}" autocomplete="off" >
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$sector_lote->id}}">
                        <input type="hidden" name="vigencia" value="{{$sector_lote->vigencia == 1 ? 0 : 1}}">
                        <button type="submit" class="btn btn-danger float-right">Eliminar</button>
                    </form>
                @endif
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Actualizar {{ Route::is('sector.update') ? 'Sector' : 'Lote' }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ Route::is('sector.update') ? route('sector.update.put') : route('lote.update.put') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="data" value="{{ Route::is('sector.update') ? 'SC' : 'LT' }}">
                <input type="hidden" name="id" value="{{$sector_lote->id}}">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputDescripcion1">Descripción</label>
                        <input type="text" name="descripcion" value="{{ $sector_lote->descripcion }}" class="form-control" id="exampleInputDescripcion1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputHectareaArea1">Hectareas/Area</label>
                        <input type="number" name="hectareas_area" value="{{ $sector_lote->hectareas_area }}" class="form-control" id="exampleInputHectareaArea1" required>
                    </div>
                    @if(Route::is('lote.update'))
                        <div class="form-group">
                            <label>Codigo Sector</label>
                            <select class="form-control" name="codigo_padre">
                                <option selected></option>
                                @forelse($sectores as $sector)
                                    <option value="{{$sector->id}}" {{ $sector_lote->codigo_padre == $sector->id ? 'selected' : '' }}>{{$sector->descripcion}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mes Afecta</label>
                            <select class="form-control" name="dualidad_mes" required>
                                <option selected></option>
                                <option value="Enero" {{ $sector_lote->dualidad_mes == 'Enero' ? 'selected' : '' }}>Enero</option>
                                <option value="Febrero" {{ $sector_lote->dualidad_mes == 'Febrero' ? 'selected' : '' }}>Febrero</option>
                                <option value="Marzo" {{ $sector_lote->dualidad_mes == 'Marzo' ? 'selected' : '' }}>Marzo</option>
                                <option value="Abril" {{ $sector_lote->dualidad_mes == 'Abril' ? 'selected' : '' }}>Abril</option>
                                <option value="Mayo" {{ $sector_lote->dualidad_mes == 'Mayo' ? 'selected' : '' }}>Mayo</option>
                                <option value="Junio" {{ $sector_lote->dualidad_mes == 'Junio' ? 'selected' : '' }}>Junio</option>
                                <option value="Julio" {{ $sector_lote->dualidad_mes == 'Julio' ? 'selected' : '' }}>Julio</option>
                                <option value="Agosto" {{ $sector_lote->dualidad_mes == 'Agosto' ? 'selected' : '' }}>Agosto</option>
                                <option value="Septiembre" {{ $sector_lote->dualidad_mes == 'Septiembre' ? 'selected' : '' }}>Septiembre</option>
                                <option value="Octubre" {{ $sector_lote->dualidad_mes == 'Octubre' ? 'selected' : '' }}>Octubre</option>
                                <option value="Noviembre" {{ $sector_lote->dualidad_mes == 'Noviembre' ? 'selected' : '' }}>Noviembre</option>
                                <option value="Diciembre" {{ $sector_lote->dualidad_mes == 'Diciembre' ? 'selected' : '' }}>Diciembre</option>
                            </select>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Vigente</label>
                        <select class="form-control" name="vigencia">
                          <option value="1" {{ $sector_lote->vigencia == 1 ? 'selected' : '' }}>Vigente</option>
                          <option value="0" {{ $sector_lote->vigencia == 0 ? 'selected' : '' }}>No Vigente</option>
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