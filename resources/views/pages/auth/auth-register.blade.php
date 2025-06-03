@extends('components/blankLayout')

@section('title', 'Inscrivez-vous')

@section('page-style')
@vite([
'resources/assets/vendor/scss/pages/page-auth.scss'
])
@endsection


@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register Card -->
      <div class="card px-sm-6 px-0">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center mb-6">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
              <span class="app-brand-text demo text-heading fw-bold">{{config('variables.appName')}}</span>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-1">L'aventure commence ici 🚀</h4>
          <p class="mb-6">Utiliser votre application avec plaisir!</p>

          @if ($errors->any())
          <div class="alert alert-danger alert-dismissible" role="alert">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

          </div>
          @endif

          <form id="formAuthentication" class="mb-6" action="{{route('auth.register')}}" method="POST">
            @csrf
            <div class="mb-6">
              <label for="username" class="form-label">Nom utilisateur</label>
              <input type="text" class="form-control @error('username')is-invalid @enderror" id="username" name="username" placeholder="Entrer votre nom utilisateur" autofocus>
              @error('username')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="mb-6">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control  @error('email')is-invalid @enderror" id="email" name="email" placeholder="Entrer votre email">
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">Mot de passe</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="forwo-control  @error('password')is-invalid @enderror" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="my-8">
              <div class="form-check mb-0 ms-2">
                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required>
                <label class="form-check-label" for="terms-conditions">
                  J'accepte les
                  <a href="javascript:void(0);">termes et conditions</a>
                </label>
              </div>
            </div>
            <button class="btn btn-primary d-grid w-100">
              S'inscrire
            </button>
          </form>

          <p class="text-center">
            <span>Vous avez déjà un compte?</span>
            <a href="{{url('auth/login')}}">
              <span>Connectez-vous</span>
            </a>
          </p>
        </div>
      </div>
      <!-- Register Card -->
    </div>
  </div>
</div>
@endsection