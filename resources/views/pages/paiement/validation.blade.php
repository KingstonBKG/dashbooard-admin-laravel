@php
$isMenu = false;
$navbarHideToggle = false;
$isNavbar = false;
@endphp

@extends('components/contentNavbarLayout')

@section('content')
    <div class="container mt-5" style="max-width: 500px;">

        {{-- Affichage des erreurs --}}
        @if ($errors->any())
            <div class="alert alert-danger" style="margin-bottom: 20px;">
                <ul style="margin-bottom: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Message de succès --}}
        @if (session('success'))
            <div class="alert alert-success" style="margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm" style="border-radius: 14px;">
            <div class="card-body">
                <p style="color:#566a7f; text-align:center;">
                    Votre paiement a bien été pris en compte.<br>
                    Merci pour votre participation à la tontine !
                </p>
                <div style="text-align:center;">
                    <a href="{{ route('paiement-index') }}" class="btn" style="background:linear-gradient(90deg,#7c3aed 0,#a78bfa 100%);color:#fff;border-radius:8px;font-weight:600;">
                        Retour à la page de paiement
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection