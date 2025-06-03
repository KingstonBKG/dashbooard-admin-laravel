@extends('components/blankLayout')

@section('title', 'Vérification de l\'email')

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card px-sm-6 px-0">
                <div class="card-body text-center">
                    <h4 class="mb-2">Vérifiez votre adresse email</h4>
                    <p class="mb-4">
                        Avant de continuer, veuillez vérifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer.<br>
                        Si vous n'avez pas reçu l'email,
                        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">cliquez ici pour en recevoir un nouveau</button>.
                        </form>
                    </p>
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection