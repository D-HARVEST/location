@extends('layouts.app')
@section('content')
    <div class="text-center">

        <lottie-player id="lottieid1" src="https://assets6.lottiefiles.com/packages/lf20_0pgmwzt3.json"
            background="transparent" speed="1" style="height:400px" loop autoplay="" class="my-5"></lottie-player>

        {{ $message }}
    </div>
@endsection
