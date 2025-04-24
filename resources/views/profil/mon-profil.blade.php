@php
    $pagetitle = 'Mon Compte';
    $breadcrumbs = ['Mon compte' => route('profile.show')];
@endphp

@extends('layouts.app')
@section('script2')
    <script>
        document.getElementById('upload-button').addEventListener('click', function() {
            document.getElementById('image-input').click();
        });


        document.getElementById('image-input').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();


                reader.onload = function(e) {
                    document.getElementById('profile-image').src = e.target.result;
                };

                reader.readAsDataURL(file);

                document.getElementById('image-upload-form').submit();
            }
        });
    </script>
@endsection
@section('content')
    <div class="card ">
        <div class="card-body ">
            <div class="d-md-flex align-items-center justify-content-between text-center text-md-start">
                <div class="d-md-flex align-items-center">
                    <form id="image-upload-form" action="{{ route('user.updateImage') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="rounded-circle position-relative mb-9 mb-md-0 d-inline-block">
                            @if (Auth::user()->image)
                                <img id="profile-image" src="{{ asset('storage/images/' . Auth::user()->image) }}"
                                    alt="" class="img-fluid rounded-circle" width="90" height="90">
                            @else
                                <img src="{{ asset('spike/assets/images/profile/user-1.jpg') }}" alt=""
                                    class="img-fluid rounded-circle" width="90" height="90">
                            @endif
                            <span id="upload-button"
                                class="text-bg-primary rounded-circle text-white d-flex align-items-center justify-content-center position-absolute bottom-0 end-0 p-1 border border-2 border-white"
                                style="cursor: pointer;">
                                <i class="ti ti-plus"></i>
                            </span>
                            <input type="file" id="image-input" name="image" accept="image/*" style="display: none;">
                        </div>
                    </form>
                    <div class="ms-0 ms-md-3 mb-9 mb-md-0">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start mb-1">
                            <h4 class="me-7 mb-0 fs-7">{{ Auth::user()->name ?? '-' }}</h4>
                        </div>
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start mb-1">
                            <span class="text-muted">
                                @role('Super-admin')
                                    Administrateur
                                @endrole
                                @role('client')
                                    Client
                                @endrole
                            </span>
                        </div>
                        <p class="text-muted mb-0 mt-1 d-flex align-items-center">
                            <iconify-icon icon="solar:mailbox-line-duotone" class="fs-4 me-1"></iconify-icon>
                            {{ Auth::user()->email ?? '-' }}
                        </p>
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                            <span class="bg-success p-1 rounded-circle"></span>
                            <h6 class="mb-0 ms-2">Active</h6>
                        </div>
                    </div>

                </div>
                {{-- <a href="#" class="btn btn-primary px-3 shadow-none">Edit Profile</a> --}}
            </div>
        </div>
    </div>

    <div class="tab-content mx-10" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
            tabindex="0">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card ">
                        <div class="card-body p-4">
                            <h4 class="fs-6 mb-9">Profile</h4>
                            <p>Mettez à jour les informations de profil de votre compte.</p>
                            <div class="py-9 border-top">
                                <form method="POST" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" id="name"
                                            value="{{ old('name', Auth::user()->name) }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email"
                                            value="{{ old('email', Auth::user()->email) }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3 text-end">
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-9">Mise à jour de mot de passe</h5>
                            <p>Mettez à jour le mot de passe de votre compte.</p>
                            <div class="py-9 border-top">
                                <form method="POST" action="{{ route('profile.password.update') }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Mot de passe actuel</label>
                                        <input type="password" name="current_password" id="current_password"
                                            class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">Nouveau Mot De Passe</label>
                                        <input type="password" name="password" id="new_password" class="form-control"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Confirmer Mot De Passe</label>
                                        <input type="password" name="password_confirmation" id="confirm_password"
                                            class="form-control" required>
                                    </div>
                                    <div class="mb-3 text-end">
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="bg-primary-subtle text-primary p-6 fs-7 rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ti ti-template"></i>
                                        </div>
                                        <div class="ms-6">
                                            <h6 class="mb-1 fs-6">680</h6>
                                            <p class="mb-0">Tasks Done</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="bg-success-subtle text-success p-6 fs-7 rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ti ti-layout-grid-add"></i>
                                        </div>
                                        <div class="ms-6">
                                            <h6 class="mb-1 fs-6">42</h6>
                                            <p class="mb-0">Projects</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="bg-danger-subtle text-danger p-6 fs-7 rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ti ti-id"></i>
                                        </div>
                                        <div class="ms-6">
                                            <h6 class="mb-1 fs-6">$780</h6>
                                            <p class="mb-0">Sales</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body p-4">
                            <h5 class="mb-9">Sessions de navigateur</h5>
                            <div class="tab-content">
                                <div class="tab-pane active" id="feeds">
                                    <p>Si nécessaire, vous pouvez vous déconnecter de toutes vos autres sessions de
                                        navigateur sur tous vos appareils.</p>

                                    <ul class="list-group mb-3">
                                        @foreach ($sessions as $session)
                                            <li class="list-group-item d-flex align-items-center">
                                                <i class="fas fa-desktop me-2 fa-2x"></i>
                                                <div>
                                                    {{ $session->device_browser }} <br> {{ $session->ip_address }},
                                                    @if ($session->id == session()->getId())
                                                        <strong>Cet appareil</strong>
                                                    @else
                                                        Autre session
                                                    @endif
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <form method="POST" action="{{ route('logout.other.sessions') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Déconnecter les autres
                                            sessions</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body p-4">
                            <h5 class="mb-9">Supprimer le compte</h5>
                            <div class="tab-content">
                                <div class="tab-pane active" id="feeds">
                                    <p>Supprimez définitivement votre compte.</p>

                                    <p>Une fois votre compte supprimé, toutes ses ressources et données seront
                                        définitivement supprimées.</p>
                                    <p>Avant de supprimer votre compte, veuillez télécharger toutes les données ou
                                        informations que vous souhaitez conserver.</p>
                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteAccountModal">Supprimer le compte</button>
                                    @include('profil.modal')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
