<div class="">
    <div class="row">
        
        <div class="form-group col-md-4 col-12 my-2">
            <strong class="mb-2 text-dark"> {{ Form::label('name') }} <span class="text-danger">*</span> </strong>
            {{ Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'required' => 'required']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-md-4 col-12 my-2">
            <strong class="mb-2 text-dark"> {{ Form::label('email') }} <span class="text-danger">*</span> </strong>
            {{ Form::text('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'required' => 'required']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt-3">
        <button type="submit" class="btn btn-success">Enregistrer</button>
    </div>
</div>
