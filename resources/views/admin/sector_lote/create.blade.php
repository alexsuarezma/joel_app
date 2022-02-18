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
                            <label>Dualidad Mes</label>
                            <select class="form-control" name="dualidad_mes" required>
                                <option selected></option>
                                <option value="ene_feb" {{ old('dualidad_mes') == 'ene_feb' ? 'selected' : '' }}>Enero-Febrero</option>
                                <option value="mar_abr" {{ old('dualidad_mes') == 'mar_abr' ? 'selected' : '' }}>Marzo-Abril</option>
                                <option value="may_jun" {{ old('dualidad_mes') == 'may_jun' ? 'selected' : '' }}>Mayo-Junio</option>
                                <option value="jul_ago" {{ old('dualidad_mes') == 'jul_ago' ? 'selected' : '' }}>Julio-Agosto</option>
                                <option value="sep_oct" {{ old('dualidad_mes') == 'sep_oct' ? 'selected' : '' }}>Septiembre-Octubre</option>
                                <option value="nov_dic" {{ old('dualidad_mes') == 'nov_dic' ? 'selected' : '' }}>Noviembre-Diciembre</option>
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