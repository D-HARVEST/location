@php
    $pagetitle = 'Détails Maison';
    $breadcrumbs = ['Liste des Maison' => route('maisons.index'), 'Détails Maison' => ''];
@endphp

@extends('layouts.app')




@section('template_title')
    Détails  Maison
@endsection


@section('content')

<!-- Modal Ajout Chambre -->
<div class="modal fade" id="createChambreModal" tabindex="-1" aria-labelledby="createChambreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('chambres.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createChambreModalLabel">Ajouter une chambre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <div class="row">

                            <div class="col-lg-6 form-group mb-2 mb20">
                                <strong> <label for="libelle" class="form-label">{{ __('Désignation du chambre') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
                                <input type="text" name="libelle" class="form-control @error('libelle') is-invalid @enderror rounded-05" value="{{ old('libelle', $chambre?->libelle) }}" id="libelle" >
                                {!! $errors->first('libelle', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            </div>
                            {{-- <div class="col-lg-6 form-group mb-2 mb20">
                                <strong> <label for="statut" class="form-label">{{ __('Statut') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
                                <input type="text" name="statut" class="form-control @error('statut') is-invalid @enderror rounded-05" value="{{ old('statut', $chambre?->statut) }}" id="statut" >
                                {!! $errors->first('statut', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            </div> --}}
                            <div class="col-lg-6 form-group mb-2 mb20">
                                <strong> <label for="jour_paiement" class="form-label">{{ __('Jour de Paiement du Loyer') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
                                <input type="text" name="jourPaiementLoyer" pattern="^(?:[1-9]|1[0-9]|2[0-8])$" title="Veuillez entrer un nombre entre 1 et 28" placeholder="Entrez le jour de paiement du loyer entre 1 et 28"  class="form-control @error('jourPaiementLoyer') is-invalid @enderror rounded-05" value="{{ old('jourPaiementLoyer', $chambre?->jourPaiementLoyer) }}" id="jour_paiement" >
                                {!! $errors->first('jourPaiement', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            </div>
                            <div class="col-lg-6 form-group mb-2 mb20">
                                <strong> <label for="loyer" class="form-label">{{ __('Prix du loyer') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
                                <input type="number" name="loyer" class="form-control @error('loyer') is-invalid @enderror rounded-05" value="{{ old('loyer', $chambre?->loyer) }}" id="loyer" >
                                {!! $errors->first('loyer', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            </div>
                            <div class="col-lg-6 form-group mb-2 mb20">
                                <strong><label for="categorie_id" class="form-label">{{ __('Catégorie') }}</label></strong>
                                <select name="categorie_id" id="categorie_id" class="form-control @error('categorie_id') is-invalid @enderror rounded-05">
                                    <option value="">-- Sélectionnez une catégorie --</option>
                                    @foreach ($categories as $id => $libelle)
                                        <option value="{{ $id }}" {{ old('categorie_id', $chambre?->categorie_id) == $id ? 'selected' : '' }}>
                                            {{ $libelle }}
                                        </option>
                                    @endforeach
                                </select>
                                {!! $errors->first('categorie_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            </div>

                            <div class="col-lg-6 form-group mb-2 mb20">
                                <strong><label for="type_id" class="form-label">{{ __('Type') }}</label></strong>
                                <select name="type_id" id="type_id" class="form-control @error('type_id') is-invalid @enderror rounded-05">
                                    <option value="">-- Sélectionnez un type --</option>
                                    @foreach ($types as $id => $libelle)
                                        <option value="{{ $id }}" {{ old('type_id', $chambre?->type_id) == $id ? 'selected' : '' }}>
                                            {{ $libelle }}
                                        </option>
                                    @endforeach
                                </select>
                                {!! $errors->first('type_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            </div>
                            <input type="hidden" name="maison_id" value="{{ $maison->id }}">
                            <div class="col-lg-6 form-group mb-2 mb20">
                                <strong><label for="maison_id" class="form-label">{{ __('Maison') }}</label></strong>
                                <input type="text" class="form-control" value="{{ $maison->libelle }}" readonly>

                                {!! $errors->first('maison_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            </div>


                        </div>
                        <div class="box-footer mt-3">
                            <button type="submit" class="btn btn-success rounded-1">Enregistrer</button>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>


    <section class="">
        <div class="row">
            <div class="col-md-12">
                <div class="card">


                    <div class="card-body">




                        <div class="col-auto">
                            <div class="text-end">
                                <a href="{{ route('maisons.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                            </div>




                        <div class="row">



                        <div class="col-lg-4">
                            <strong class="text-dark ">Nom de la maison:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $maison->libelle }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Pays:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $maison->Pays }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Ville:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $maison->ville }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Quartier:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $maison->quartier }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Adresse:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $maison->adresse }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Gérant:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $maison->user->name }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Jour de paiement loyer:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $maison->jourPaiementLoyer }}"
                                readonly>
                        </div>

                        </div>
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('chambre.index')
                </div>
            </div>

        </div>
    </section>


@endsection


