@php
    $pagetitle = 'Ma Chambre';
    $breadcrumbs = ['Liste des Chambre' => route('chambres.index'), 'Ma  chambre' => ''];
@endphp

@extends('layouts.app')

@section('template_title')
    Mes Chambres
@endsection

@section('content')

<!-- Modal Ajout Chambre -->
<div class="modal fade" id="createChambreModal" tabindex="-1" aria-labelledby="createChambreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('louerchambres.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createChambreModalLabel">Remplissez les informations</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">


                    <div class="">
                        <div class="row">

                            <div class="col-lg-6 form-group mb-2 mb20">
                                <strong>
                                    <label for="chambre_libelle" class="form-label">{{ __('Chambre') }}</label>
                                </strong>
                                <input type="text" class="form-control rounded-05" id="chambre_libelle"
                                       value="{{ $chambre->libelle ?? '' }}" readonly>
                                <input type="hidden" name="chambre_id" value="{{ $chambre->id ?? '' }}">
                            </div>


                            <div class="col-lg-6 form-group mb-2 mb20">
                                <strong> <label for="debut_occupation" class="form-label">{{ __("Date d'entrée") }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
                                <input type="date" name="debutOccupation" class="form-control @error('debutOccupation') is-invalid @enderror rounded-05" value="{{ old('debutOccupation', $louerchambre?->debutOccupation) }}" id="debut_occupation" required >
                                {!! $errors->first('debutOccupation', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            </div>

                            <div class="col-lg-6 form-group mb-2 mb20">
                                <strong> <label for="loyer" class="form-label">{{ __('Prix du loyer') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
                                <input type="text" class="form-control rounded-05" id="loyer"  value="{{$chambre->loyer ?? ''}}" readonly>
                                <input type="hidden" name="loyer" value="{{ $chambre->loyer ?? '' }}">
                                {{-- <input type="text" name="loyer" class="form-control @error('loyer') is-invalid @enderror rounded-05" value="{{ old('loyer', $louerchambre?->loyer) }}" id="loyer" required> --}}
                                {!! $errors->first('loyer', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            </div>
                            {{-- <div class="col-lg-6 form-group mb-2 mb20">
                                <strong> <label for="statut" class="form-label">{{ __('Statut') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
                                <input type="text" name="statut" class="form-control @error('statut') is-invalid @enderror rounded-05" value="{{ old('statut', $louerchambre?->statut) }}" id="statut" >
                                {!! $errors->first('statut', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            </div> --}}
                            <div class="col-lg-6 form-group mb-2 mb20">
                                <strong> <label for="caution_loyer" class="form-label">{{ __('Prix caution du loyer') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
                                <input type="number" name="cautionLoyer" class="form-control @error('cautionLoyer') is-invalid @enderror rounded-05" value="{{ old('cautionLoyer', $louerchambre?->cautionLoyer) }}" id="caution_loyer" >
                                {!! $errors->first('cautionLoyer', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            </div>
                            <div class="col-lg-6 form-group mb-2 mb20">
                                <strong> <label for="caution_electricite" class="form-label">{{ __('Prix caution electricite') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
                                <input type="number" name="cautionElectricite" class="form-control @error('cautionElectricite') is-invalid @enderror rounded-05" value="{{ old('cautionElectricite', $louerchambre?->cautionElectricite) }}" id="caution_electricite" >
                                {!! $errors->first('cautionElectricite', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            </div>
                            <div class="col-lg-6 form-group mb-2 mb20">
                                <strong> <label for="caution_eau" class="form-label">{{ __('Prix caution eau') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
                                <input type="number" name="cautionEau" class="form-control @error('cautionEau') is-invalid @enderror rounded-05" value="{{ old('cautionEau', $louerchambre?->cautionEau) }}" id="caution_eau" >
                                {!! $errors->first('cautionEau', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            </div>
                            {{-- <div class="col-lg-6 form-group mb-2 mb20">
                                <strong> <label for="copie_contrat" class="form-label">{{ __('Copie du contrat') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
                                <input type="file" name="copieContrat" class="form-control @error('copieContrat') is-invalid @enderror rounded-05" value="{{ old('copieContrat', $louerchambre?->copieContrat) }}" id="copie_contrat" >
                                {!! $errors->first('copieContrat', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            </div> --}}
                            <div class="col-lg-6 form-group mb-2 mb20">
                                <strong> <label for="jour_paiement_loyer" class="form-label">{{ __('Jour paiement loyer') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
                                <input type="text" class="form-control rounded-05" value="{{ $chambre->jourPaiementLoyer ?? '' }}" readonly>
                                <input type="hidden" name="jourPaiementLoyer" value="{{ $chambre->jourPaiementLoyer ?? '' }}">

                                {{-- <input type="text" name="jourPaiementLoyer" pattern="^(?:[1-9]|1[0-9]|2[0-8])$" title="Veuillez entrer un nombre entre 1 et 28" placeholder="Entrez le jour de paiement du loyer entre 1 et 28"  class="form-control @error('jourPaiementLoyer') is-invalid @enderror rounded-05" value="{{ old('jourPaiementLoyer', $louerchambre?->jourPaiementLoyer) }}" id="jour_paiement_loyer"  required> --}}
                                {!! $errors->first('jourPaiementLoyer', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            </div>



                            <hr>
                            <h4 class="mb-4"> Remplissez les informations personnelles du locataire</h4>

                          <div class="form-group mb-2 mb20">
                              <label for="name" class="form-label">{{ __('Nom et Prénom') }}</label>
                              <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name"
                              value="{{ old('name', $user->name) }}" required>
                              {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                          </div>


                          <div class="form-group mb-2 mb20">
                            <label for="npi" class="form-label">{{ __('NPI') }}</label>
                            <input type="text" class="form-control  @error('npi') is-invalid @enderror" id="npi" name="npi"
                            value="{{ old('npi', $user->npi) }}" required>
                            {!! $errors->first('npi', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>





                        {{-- <div class="form-group mb-2 mb20">
                            <label for="phone" class="form-label">{{ __('Téléphone') }}</label>
                            <input type="text" class="form-control  @error('phone') is-invalid @enderror" id="phone" name="phone"
                            value="{{ old('phone', $user->phone) }}" required>
                            {!! $errors->first('phone', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div> --}}


                          <div class="mb-3">
                              <label for="email" class="form-label">{{ __('Email') }}</label>
                              <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" name="email"
                              value="{{ old('email', $user->email) }}" required>
                              {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                          </div>


                          {{-- <div class="mb-3">
                              <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                              <input type="password" class="form-control  @error('password') is-invalid @enderror" id="password" name="password"
                              value="{{ old('password', $user->password) }}"
                               required>
                              {!! $errors->first('password', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                          </div> --}}


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
            {{-- <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="text-end mb-3">
                            <a href="{{ route('maisons.show', $chambre->maison_id) }}" class="btn btn-sm btn-primary">Retour</a>
                        </div>

                        <div class="row g-4">
                            @php
                                $infos = [
                                    'Libellé' => $chambre->libelle,
                                    'Jour de paiement de loyer' => $chambre->jourPaiementLoyer,
                                    'Loyer' => number_format($chambre->loyer, 0, ',', ' ') . ' FCFA',
                                    'Catégorie' => optional($chambre->category)->libelle,
                                    'Type' => optional($chambre->type)->libelle,
                                    'Maison' => optional($chambre->maison)->libelle,
                                ];
                            @endphp

                            @foreach ($infos as $label => $value)
                                <div class="col-lg-4">
                                    <div class="bg-light p-3 rounded">
                                        <div class="text-muted small">{{ $label }}</div>
                                        <div class="fw-semibold text-dark">{{ $value }}</div>
                                    </div>
                                </div>
                            @endforeach

                            @php
                                $badgeClass = $chambre->statut === 'Disponible' ? 'success' : 'danger';
                            @endphp

                            <div class="col-lg-4">
                                <div class="bg-light p-3 rounded">
                                    <div class="text-muted small">Statut</div>
                                    <span class="badge bg-{{ $badgeClass }}">{{ $chambre->statut }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}


            <div class="row">
                <div class="col-md-12">
                    @include('louerchambre.index')
                </div>
            </div>
        </div>
    </section>
@endsection
