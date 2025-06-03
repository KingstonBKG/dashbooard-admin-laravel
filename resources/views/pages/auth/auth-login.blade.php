@extends('components/blankLayout')

@section('title', 'Connectez-vous')

@section('page-style')
@vite([
'resources/assets/vendor/scss/pages/page-auth.scss'
])
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card px-sm-6 px-0">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
              <span class="app-brand-text demo text-heading fw-bold">{{config('variables.appName')}}</span>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-1">Bienvenue sur {{config('variables.appName')}}! 👋</h4>
          <p class="mb-6">Entrez vos informations pour vous connecter</p>

          @if(session('message'))
          <div class="alert alert-success">
            {{ session('message') }}
          </div>
          @endif

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

          <form id="formAuthentication" class="mb-6" action="{{ route('auth.login') }}" method="POST">
            @csrf
            <div class="mb-6">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control @error('email') is-valid @enderror" id="email" name="email" placeholder="Entrer votre email ou nom utilisateur" autofocus value="{{ old('email') }}">
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">Mot de passe</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control @error('password') is-valid @enderror" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="mb-8">
              <div class="d-flex justify-content-between mt-8">
                <div class="form-check mb-0 ms-2">
                  <input class="form-check-input" type="checkbox" id="remember-me">
                  <label class="form-check-label" for="remember-me">
                    Se souvenir de moi
                  </label>
                </div>
                <a href="{{url('auth/forgot-password')}}">
                  <span>Mot de passe oublié?</span>
                </a>
              </div>
            </div>
            <div class="mb-6">
              <button class="btn btn-primary d-grid w-100" type="submit">Connexion</button>
            </div>
          </form>

          <p class="text-center">
            <span>Vous êtes nouveau?</span>
            <a href="{{url(path: 'auth/register')}}">
              <span>Créer un compte</span>
            </a>
          </p>
        </div>
      </div>
    </div>
    <!-- /Register -->
  </div>
</div>
@endsection