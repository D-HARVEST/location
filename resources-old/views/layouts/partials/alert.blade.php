@if (session()->has('successMessage'))
    <div class="alert alert-success " role="alert">
        <h5 class="alert-title">
            <i class="fa fa-check-circle "></i> Succès !
        </h5>
        <div class="">
            {{ session('successMessage') }}
        </div>
    </div>
@endif
@if (session()->has('success'))
    <div class="alert alert-success " role="alert">
        <h5 class="alert-title">
            <i class="fa fa-check-circle "></i> Succès !
        </h5>
        <div class="">
            {{ session('success') }}
        </div>
    </div>
@endif
@if (session()->has('alertMessage'))
    <div class="alert alert-warning " role="alert">
        <h5 class="alert-title">
            <i class="fa fa-warning "></i> Attention !
        </h5>
        <div class="">
            {{ session('alertMessage') }}
        </div>
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-danger " role="alert">
        <h5 class="alert-title">
            <i class="fa fa-circle-xmark text-danger "></i> Erreur !
        </h5>
        <div class="">
            {{ session('error') }}
        </div>
    </div>
@endif
@if (session()->has('errorMessage'))
    <div class="alert alert-danger " role="alert">
        <h5 class="alert-title">
            <i class="fa fa-circle-xmark text-danger "></i> Erreur !
        </h5>
        <div class="">
            {{ session('errorMessage') }}
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger mt-3" role="alert">
        <div class="d-flex">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon icon icon-tabler icon-tabler-circle-x"
                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="12" r="9"></circle>
                    <path d="M10 10l4 4m0 -4l-4 4"></path>
                </svg>
            </div>
            <div class="ml-auto">
                <h4 class="alert-title"> Oops !</h4>
                <div class="text-muted">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
