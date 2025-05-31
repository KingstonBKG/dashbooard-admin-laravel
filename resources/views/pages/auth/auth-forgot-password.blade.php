@extends('components/blankLayout')

@section('title', 'Forgot Password Basic - Pages')

@section('page-style')
@vite([
  'resources/assets/vendor/scss/pages/page-auth.scss'
])
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">

      <!-- Forgot Password -->
      <div class="card px-sm-6 px-0">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center mb-6">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
              <span class="app-brand-text demo text-heading fw-bold">{{ config('variables.appName') }}</span>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-1">Mot de de passe oublié? 🔒</h4>
          <p class="mb-6">Entrer votre email et nous vous enverrons des instructions de réinitialisation</p>
          <form id="formAuthentication" class="mb-6" action="{{url('/')}}" method="GET">
            <div class="mb-6">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Entrer votre email" autofocus>
            </div>
            <button class="btn btn-primary d-grid w-100">Envoyer le lien</button>
          </form>
          <diRe class="text-center">
            <a href="{{url('auth/login')}}" class="d-flex justify-content-center">
              <i class="bx bx-chevron-left scaleX-n1-rtl me-1"></i>
              Retour à la connexion
            </a>
          </div>
        </div>
      </div>
      <!-- /Forgot Password -->
    </div>
  </div>
</div>
@endsection
