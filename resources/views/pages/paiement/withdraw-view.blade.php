@php
$isMenu = false;
$navbarHideToggle = false;
$isNavbar = false;
@endphp


@extends('components/contentNavbarLayout')

@section('vendor-style')
@vite('resources/assets/vendor/libs/apex-charts/apex-charts.scss')
@endsection

@section('vendor-script')
@vite('resources/assets/vendor/libs/apex-charts/apexcharts.js')
@endsection

@section('page-script')
@vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')
<style>
    .paiement-container {
        max-width: 420px;
        margin: 48px auto;
        padding: 32px 28px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 6px 24px rgba(105, 108, 255, 0.08), 0 1.5px 6px rgba(44, 62, 80, 0.04);
        border: 1px solid #e3e6ed;
        position: relative;
        overflow: hidden;
    }

    .paiement-container::before {
        content: "";
        position: absolute;
        top: -60px;
        right: -60px;
        width: 160px;
        height: 160px;
        background: linear-gradient(135deg, #7c3aed 60%, #a78bfa 100%);
        opacity: 0.18;
        /* Cercle plus visible et bien violet */
        border-radius: 50%;
        z-index: 0;
    }

    .paiement-container h2 {
        text-align: center;
        margin-bottom: 28px;
        color: #566a7f;
        font-weight: 700;
        font-size: 2rem;
        letter-spacing: 1px;
        position: relative;
        z-index: 1;
    }

    .paiement-container label {
        font-weight: 600;
        margin-bottom: 7px;
        color: #697a8d;
        display: block;
        position: relative;
        z-index: 1;
    }

    .paiement-container select,
    .paiement-container input[type="number"] {
        width: 100%;
        padding: 12px 14px;
        margin-bottom: 22px;
        border: 1px solid #d9dee3;
        border-radius: 10px;
        font-size: 17px;
        background: #f5f6fa;
        color: #566a7f;
        transition: border-color 0.2s, box-shadow 0.2s;
        position: relative;
        z-index: 1;
        box-shadow: 0 1px 2px rgba(105, 108, 255, 0.04);
    }

    .paiement-container select:focus,
    .paiement-container input[type="number"]:focus {
        border-color: #7c3aed;
        outline: none;
        background: #fff;
        box-shadow: 0 0 0 2px #e7e7fb;
    }



    .paiement-container .icon {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 18px;
        position: relative;
        z-index: 1;
    }

    .paiement-container .icon svg {
        width: 48px;
        height: 48px;
        fill: #fff;
        border-radius: 50%;
        padding: 8px;
        box-shadow: 0 2px 8px rgba(124, 58, 237, 0.10);
    }
</style>
<div class="paiement-container">
    <div class="icon">
        <!-- Violet payment SVG icon -->
        <svg viewBox="0 0 48 48">
            <rect x="6" y="14" width="36" height="20" rx="4" fill="#a78bfa" opacity="0.18" />
            <rect x="6" y="14" width="36" height="20" rx="4" stroke="#7c3aed" stroke-width="2" fill="none" />
            <rect x="10" y="22" width="10" height="4" rx="2" fill="#7c3aed" />
        </svg>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{!! $error !!}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    </div>
    @endif

    <h2>Paiement</h2>

    <form action="{{ route('paiement.store', request()->route()->parameter('id')) }}" method="POST" autocomplete="off">
        @csrf
        <label for="moyen">Moyen de paiement</label>
        <select id="moyen" name="moyen" required class="">
            <option value="">Sélectionnez un moyen</option>
            <option value="bank_card">Carte bancaire</option>
            <option value="mobile_money">Mobile Money</option>
            <option value="orange_money">Orange Money</option>
        </select>

        <label for="destinataire">Destinataire</label>
        <select id="destinataire" name="destinataire_id" required class="">
            <option value="">Sélectionnez un membre</option>
            @foreach ($membres as $membre)
            <option value="{{ $membre->id }}">{{ $membre->username }} ({{ $membre->email }})</option>
            @endforeach
        </select>

        <input type="hidden" name="type" value="withdraw">
        <label for="montant" class="form-laber">Montant</label>
        <input type="number" id="montant" name="montant" min="1" class="form-control" placeholder="min. 1000 FCFA" required>
        <input type="hidden" name="tontine_id" value="{{request()->route()->parameter('id')}}">
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <button type="submit" class="btn btn-primary w-100">Envoyer</button>
    </form>
</div>
@endsection