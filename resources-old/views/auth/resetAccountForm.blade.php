<form action="{{ route('account-reset') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-12 my-2">
            <strong class="text-dark"> <label for="">Université</label> <span class="text-danger"> * </span>
            </strong>
            {{ Form::select('Universite', App\Models\Universite::pluck('LibelleLongUniversite', 'CodeUniversite'), null, ['required' => 'required', 'class' => 'form-select', 'placeholder' => '-- Sélectionner --']) }}
        </div>

        <div class="col-12 my-2">
            <strong class="text-dark"> {{ Form::label('Matricule') }} <span class="text-danger"> * </span></strong>

            {{ Form::text('Matricule', null, ['minlength' => '8', 'class' => 'form-control' . ($errors->has('Matricule') ? ' is-invalid' : ''), 'required' => 'required']) }}
            {!! $errors->first('Matricule', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="col-12 my-2">
            <strong class="text-dark"><label for="DateNaissanceEtudiant">Date de Naissance</label> <span
                    class="text-danger"> * </span></strong>
            {{ Form::date('DateNaissanceEtudiant', null, ['required' => 'required', 'class' => 'form-control' . ($errors->has('DateNaissanceEtudiant') ? ' is-invalid' : '')]) }}
            {!! $errors->first('DateNaissanceEtudiant', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="col-12 my-2">
            <div class="fw-bold text-dark">{{ Form::label('NPI') }} <span class="text-danger"> * </span>
            </div>
            {{ Form::number('NPI', null, ['minlength' => '9', 'maxlength' => '12', 'required' => 'required', 'class' => 'form-control' . ($errors->has('NPI') ? ' is-invalid' : '')]) }}
            {!! $errors->first('NPI', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="col-12 my-2">
            <div class="fw-bold text-dark">
                <label for="Telephone">N° Téléphone</label> <span class="text-danger"> * </span>
            </div>
            {{ Form::number('Telephone', null, ['id' => 'Telephone', 'minlength' => '24', 'maxlength' => '24', 'class' => 'form-control' . ($errors->has('Telephone') ? ' is-invalid' : ''), 'required' => 'required']) }}
            {!! $errors->first('Telephone', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="col-12 ">
            <button class="btn w-100 btn-success text-white fw-bold my-3">Soumettre</button>
        </div>


    </div>
</form>
