@php
    $pagetitle = 'Détails Intervention';
    $breadcrumbs = ['Liste des Intervention' => route('interventions.index'), 'Détails Intervention' => ''];
@endphp

@extends('layouts.app')

@section('template_title')
    Détails  Intervention
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">
                <div class="card">


                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('interventions.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="row">



                        <div class="col-lg-4">
                            <strong class="text-dark ">Libelle:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $intervention->libelle }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Date de soumission d'intervention:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $intervention->created_at }}"
                                readonly>
                        </div>


                        <div class="col-lg-4">
                            <strong class="text-dark ">Description:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $intervention->description }}"
                                readonly>
                        </div>

                        <div class="col-lg-4 mt-4">
                            <strong class="text-dark ">Statut:</strong>
                            {{-- <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $intervention->statut }}"
                                readonly> --}}
                                @php
                                $badgeColor = match($intervention->statut) {
                                    'EN ATTENTE' => 'warning',
                                    'CONFIRMER' => 'success',
                                    'REJETER' => 'danger',

                                };
                            @endphp
                            <span class="badge bg-{{ $badgeColor }}">
                                {{ $intervention->statut }}
                            </span>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
