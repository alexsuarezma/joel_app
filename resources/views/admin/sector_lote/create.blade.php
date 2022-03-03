<x-app-layout>
    <x-slot name="header">
        Registrar {{ Route::is('sector.create') ? 'Sector' : 'Hectarea' }}
    </x-slot>
    <div class="container">
        <!-- general form elements -->
        <x-toast-message></x-toast-message>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Registrar {{ Route::is('sector.create') ? 'Sector' : 'Hectarea' }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ Route::is('sector.create') ? route('sector.create.post') : route('lote.create.post') }}">
                @csrf
                <input type="hidden" name="data" value="{{ Route::is('sector.create') ? 'SC' : 'LT' }}">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputDescripcion1">Descripción</label>
                        <input type="text" name="descripcion" value="{{ old('descripcion') }}" class="form-control" id="exampleInputDescripcion1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputHectareaArea1">Hectareas/Area</label>
                        <input type="number" name="hectareas_area" value="{{ old('hectareas_area') }}" class="form-control" id="exampleInputHectareaArea1" required>
                    </div>
                    @if(Route::is('lote.create'))
                        <div class="form-group">
                            <label>Codigo Sector</label>
                            <select class="form-control" name="codigo_padre">
                                <option selected></option>
                                @forelse($sectores as $sector)
                                    <option value="{{$sector->id}}" {{ old('codigo_padre') == $sector->id ? 'selected' : '' }}>{{$sector->descripcion}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mes Afecta</label>
                            <select class="form-control" name="dualidad_mes" required>
                                <option selected></option>
                                <option value="Enero" {{ old('dualidad_mes') == 'Enero' ? 'selected' : '' }}>Enero</option>
                                <option value="Febrero" {{ old('dualidad_mes') == 'Febrero' ? 'selected' : '' }}>Febrero</option>
                                <option value="Marzo" {{ old('dualidad_mes') == 'Marzo' ? 'selected' : '' }}>Marzo</option>
                                <option value="Abril" {{ old('dualidad_mes') == 'Abril' ? 'selected' : '' }}>Abril</option>
                                <option value="Mayo" {{ old('dualidad_mes') == 'Mayo' ? 'selected' : '' }}>Mayo</option>
                                <option value="Junio" {{ old('dualidad_mes') == 'Junio' ? 'selected' : '' }}>Junio</option>
                                <option value="Julio" {{ old('dualidad_mes') == 'Julio' ? 'selected' : '' }}>Julio</option>
                                <option value="Agosto" {{ old('dualidad_mes') == 'Agosto' ? 'selected' : '' }}>Agosto</option>
                                <option value="Septiembre" {{ old('dualidad_mes') == 'Septiembre' ? 'selected' : '' }}>Septiembre</option>
                                <option value="Octubre" {{ old('dualidad_mes') == 'Octubre' ? 'selected' : '' }}>Octubre</option>
                                <option value="Noviembre" {{ old('dualidad_mes') == 'Noviembre' ? 'selected' : '' }}>Noviembre</option>
                                <option value="Diciembre" {{ old('dualidad_mes') == 'Diciembre' ? 'selected' : '' }}>Diciembre</option>
                            </select>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Vigente</label>
                        <select class="form-control" name="vigencia">
                          <option value="1" {{ old('vigencia') == 1 ? 'selected' : '' }}>Vigente</option>
                          <option value="0" {{ old('vigencia') == 0 && !empty(old('vigencia')) ? 'selected' : '' }}>No Vigente</option>
                        </select>
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