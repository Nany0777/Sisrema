<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                   id="nombre" name="nombre" value="{{ old('nombre') }}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control @error('apellido') is-invalid @enderror" 
                   id="apellido" name="apellido" value="{{ old('apellido') }}" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="ci" class="form-label">Cédula</label>
            <input type="number" class="form-control @error('ci') is-invalid @enderror" 
                   id="ci" name="ci" value="{{ old('ci') }}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="edad" class="form-label">Edad</label>
            <input type="number" class="form-control @error('edad') is-invalid @enderror" 
                   id="edad" name="edad" value="{{ old('edad') }}" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="sexo" class="form-label">Sexo</label>
            <select class="form-select @error('sexo') is-invalid @enderror" id="sexo" name="sexo" required>
                <option value="">Seleccione...</option>
                <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="peso" class="form-label">Peso (kg)</label>
            <input type="number" step="0.01" class="form-control @error('peso') is-invalid @enderror" 
                   id="peso" name="peso" value="{{ old('peso') }}" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="nacionalidad" class="form-label">Nacionalidad</label>
            <select class="form-select @error('nacionalidad') is-invalid @enderror" id="nacionalidad" name="nacionalidad" required>
                <option value="">Seleccione...</option>
                <option value="Venezolano" {{ old('nacionalidad') == 'Venezolano' ? 'selected' : '' }}>Venezolano</option>
                <option value="Extranjero" {{ old('nacionalidad') == 'Extranjero' ? 'selected' : '' }}>Extranjero</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="ocupacion" class="form-label">Ocupación</label>
            <input type="text" class="form-control @error('ocupacion') is-invalid @enderror" 
                   id="ocupacion" name="ocupacion" value="{{ old('ocupacion') }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="representante" class="form-label">Representante</label>
            <input type="text" class="form-control @error('representante') is-invalid @enderror" 
                   id="representante" name="representante" value="{{ old('representante') }}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="number" class="form-control @error('telefono') is-invalid @enderror" 
                   id="telefono" name="telef ono" value="{{ old('telefono') }}" required>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="embarazo" name="embarazo" value="1" {{ old('embarazo') ? 'checked' : '' }}>
            <label class="form-check-label" for="embarazo">
                Embarazo
            </label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="madre_lactante" name="madre_lactante" value="1" {{ old('madre_lactante') ? 'checked' : '' }}>
            <label class="form-check-label" for="madre_lactante">
                Madre Lactante
            </label>
        </div>
    </div>
</div>

<div class="form-group mb-3">
    <label for="direccion" class="form-label">Dirección</label>
    <textarea class="form-control @error('direccion') is-invalid @enderror" 
              id="direccion" name="direccion" rows="3" required>{{ old('direccion') }}</textarea>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="id_state" class="form-label">Estado</label>
            <select class="form-select @error('id_state') is-invalid @enderror" id="id_state" name="id_state" required>
                <option value="">Seleccione...</option>
                @foreach($states as $state)
                    <option value="{{ $state->id }}" {{ old('id_state') == $state->id ? 'selected' : '' }}>
                        {{ $state->state }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="id_city" class="form-label">Ciudad</label>
            <select class="form-select @error('id_city') is-invalid @enderror" id="id_city" name="id_city" required>
                <option value="">Seleccione...</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" {{ old('id_city') == $city->id ? 'selected' : '' }}>
                        {{ $city->city }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="id_municipality" class="form-label">Municipio</label>
            <select class="form-select @error('id_municipality') is-invalid @enderror" id="id_municipality" name="id_municipality" required>
                <option value="">Seleccione...</option>
                @foreach($municipalities as $municipality)
                    <option value="{{ $municipality->id }}" {{ old('id_municipality') == $municipality->id ? 'selected' : '' }}>
                        {{ $municipality->municipality }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="id_parish" class="form-label">Parroquia</label>
            <select class="form-select @error('id_parish') is-invalid @enderror" id="id_parish" name="id_parish" required>
                <option value="">Seleccione...</option>
                @foreach($parishes as $parish)
                    <option value="{{ $parish->id }}" {{ old('id_parish') == $parish->id ? 'selected' : '' }}>
                        {{ $parish->parish }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div> 

<script>

</script>