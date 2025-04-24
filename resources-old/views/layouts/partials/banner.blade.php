@if (!($withoutBarner ?? false) == true)
    <div class="card shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body d-flex align-items-center justify-content-between p-4">
            <h4 class="fw-semibold mb-0">{!! $pagetitle ?? '' !!}</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="{{ route('home') }}">Accueil</a>
                    </li>
                    {{-- <li class="breadcrumb-item" aria-current="page">Shop</li> --}}

                    @foreach ($breadcrumbs ?? [] as $bkey => $bvalue)
                        <li class="breadcrumb-item" @if ($loop->last) aria-current="page" @endif>
                            <a class="text-muted text-decoration-none" href="{{ $bvalue }}">
                                {{ $bkey }}
                            </a>
                        </li>
                    @endforeach
                </ol>
            </nav>
        </div>
    </div>
@endif
