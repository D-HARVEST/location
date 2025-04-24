<div class="">
    <div class="row">

        <div class="col-lg-12 form-group mb-2 mb20">
            <strong> <label for="name" class="form-label">{{ __('Nom et Prénoms') }}</label>
                <!-- <strong class="text-danger"> * </strong> --> </strong>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror rounded-05"
                value="{{ old('name', $user?->name) }}" id="name">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-12 form-group mb-2 mb20">
            <strong> <label for="email" class="form-label">{{ __('Email') }}</label>
                <!-- <strong class="text-danger"> * </strong> --> </strong>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror rounded-05"
                value="{{ old('email', $user?->email) }}" id="email">
            {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-12 form-group mb-2 mb20">
            <strong> <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                <!-- <strong class="text-danger"> * </strong> --> </strong>
            <input type="text" name="password"
                class="form-control @error('password') is-invalid @enderror rounded-05"
                value="{{ old('password', $user?->password) }}" id="password">
            {!! $errors->first('password', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        {{-- <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="last_login_at" class="form-label">{{ __('Last Login At') }}</label>
                <!-- <strong class="text-danger"> * </strong> --> </strong>
            <input type="text" name="last_login_at"
                class="form-control @error('last_login_at') is-invalid @enderror rounded-05"
                value="{{ old('last_login_at', $user?->last_login_at) }}" id="last_login_at">
            {!! $errors->first(
                'last_login_at',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div> --}}

    </div>
    <div class="box-footer mt-3">
        <button type="submit" class="btn btn-success rounded-1">Enregistrer</button>
    </div>
</div>
