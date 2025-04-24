<div class="">
    <div class="row">

        <div class="form-group mb-2 mb20">
            <strong> <label for="name" class="form-label">{{ __('Name') }}</label>
                <!-- <strong class="text-danger"> * </strong> --> </strong>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror rounded-05"
                value="{{ old('name', $role?->name) }}" id="name">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        {{-- <div class="form-group mb-2 mb20">
            <strong> <label for="guard_name" class="form-label">{{ __('Guard Name') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="guard_name" class="form-control @error('guard_name') is-invalid @enderror rounded-05" value="{{ old('guard_name', $role?->guard_name) }}" id="guard_name" >
            {!! $errors->first('guard_name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}

    </div>
    <div class="box-footer mt-3">
        <button type="submit" class="btn btn-success rounded-1">Enregistrer</button>
    </div>
</div>
