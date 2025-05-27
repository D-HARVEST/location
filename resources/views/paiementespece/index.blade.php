@php
    $pagetitle = 'Liste des Paiementespece(s)';
    $breadcrumbs = ['Liste des Paiementespece(s)' => route('paiementespeces.index')];
@endphp

@extends('layouts.app')


@section('content')
    <div class="">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">



                    <div class="card-body">
                      @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <div class="text-end">
                            <a href="{{ route('paiementespeces.create') }}" class="btn btn-sm btn-primary rounded-05"> Nouveau</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Paiementespece(s)</h5>
                            <span>Liste des Paiementespece(s)</span>
                            <hr>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover datatable">
                                <thead class="thead">
                                    <tr>
                                        <th>N°</th>

									<th >Motif</th>
									<th >Montant</th>
									<th >Date</th>
                                    <th >Date de Reception</th>
                                    <th >Mois</th>
									<th >Observation</th>
									<th >Locataire</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paiementespeces as $paiementespece)
                                        <tr>
                                            <td>{{ ++$i }}</td>

										<td >{{ $paiementespece->Motif }}</td>
										<td >{{ $paiementespece->Montant }}</td>
										<td >{{ $paiementespece->Date }}</td>
                                        <td >{{ $paiementespece->DateReception }}</td>
                                        <td >{{ $paiementespece->Mois }}</td>
										<td >{{ $paiementespece->observation }}</td>
										<td >{{ $paiementespece->louerchambre->user->name}} / {{ $paiementespece->louerchambre->chambre->libelle }} / {{ $paiementespece->louerchambre->chambre->maison->libelle }}</td>

                                            <td>
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0)" class="text-muted show" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                        aria-expanded="true">
                                                        <i class="ti ti-dots-vertical fs-5"></i>
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                                        style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-20px, 1.6px, 0px);"
                                                        data-popper-placement="left-start">
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('paiementespeces.show',$paiementespece->id) }}">
                                                                <i class="fs-4 ti ti-eye"></i> Détails
                                                            </a>
                                                        </li>
                                                       
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('paiementespeces.edit',$paiementespece->id) }}">
                                                                <i class="fs-4 ti ti-edit"></i> Modifier
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('paiementespeces.destroy',$paiementespece->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">
                                                                <i class="fs-4 ti ti-trash"></i> {{ __('Supprimer') }}
                                                                </button>
                                                            </form>

                                                        </li>
                                                    </ul>
                                                </div>
                                                {{--
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="{{ route('paiementespeces.show',$paiementespece->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Détails') }}</a>
                                                            <a class="dropdown-item" href="{{ route('paiementespeces.edit',$paiementespece->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Modifier') }}</a>
                                                            <div class="dropdown-divider"></div>
                                                            <form action="{{ route('paiementespeces.destroy',$paiementespece->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger"><i class="fa fa-fw fa-trash"></i> {{ __('Supprimer') }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                --}}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- {!! $paiementespeces->withQueryString()->links() !!} --}}
            </div>
        </div>
    </div>
@endsection
