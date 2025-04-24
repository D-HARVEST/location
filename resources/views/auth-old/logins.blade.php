@extends('layouts.app')

@section('content')
 <div id="main-wrapper" class="p-0 bg-white">
      <div
        class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center"
      >
        <div class="auth-login-shape-box position-relative">
          <div
            class="d-flex align-items-center justify-content-center w-100 z-1 position-relative"
          >
            <div class="card auth-card mb-0 mx-3">
              <div class="card-body pt-5">
                <a
                  href="index.html"
                  class="text-nowrap logo-img text-center d-flex align-items-center justify-content-center mb-5 w-100"
                >
                  <img
                    src="./../assets/images/logos/logo-dark.svg"
                    class="light-logo"
                    alt="Logo-Dark"
                  />
                  <img
                    src="./../assets/images/logos/logo-light.svg"
                    class="dark-logo"
                    alt="Logo-light"
                  />
                </a>
                <form>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"
                      >Username</label
                    >
                    <input
                      type="email"
                      class="form-control"
                      id="exampleInputEmail1"
                      aria-describedby="emailHelp"
                    />
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label"
                      >Password</label
                    >
                    <input
                      type="password"
                      class="form-control"
                      id="exampleInputPassword1"
                    />
                  </div>
                  <div
                    class="d-flex align-items-center justify-content-between mb-4"
                  >
                    <div class="form-check">
                      <input
                        class="form-check-input primary"
                        type="checkbox"
                        value=""
                        id="flexCheckChecked"
                        checked
                      />
                      <label
                        class="form-check-label text-dark"
                        for="flexCheckChecked"
                      >
                        Remeber this Device
                      </label>
                    </div>
                    <a
                      class="text-primary fw-medium"
                      href="authentication-forgot-password.html"
                      >Forgot Password ?</a
                    >
                  </div>
                  <a
                    href="index.html"
                    class="btn btn-primary w-100 mb-4 rounded-pill"
                    >Sign In</a
                  >
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-medium">New to Spike?</p>
                    <a
                      class="text-primary fw-medium ms-2"
                      href="authentication-register.html"
                      >Create an account</a
                    >
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="dark-transparent sidebartoggler"></div>
    </div>
@endsection
