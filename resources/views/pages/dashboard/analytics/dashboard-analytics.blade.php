@extends('components/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('content')
<div class="row g-4">

  <div class="col-xxl-8 mb-6 order-0">
    <div class="card">
      <div class="d-flex align-items-start row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary mb-3">Félicitations {{ Auth::user()->username }}! 🎉</h5>
            <p class="mb-6">Bienvenu sur TontiFlex. Vous avez effectué {{ count($paiments[0]) }} paiment(s),<br>et {{ count($paiments[1]) }} gains(s).</p>

            <a href="{{ route('tontines-tontines') }}" class="btn btn-sm btn-outline-primary">Voir les tontines</a>
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-d-6">
            <img src="{{asset('assets/img/illustrations/man-with-laptop.png')}}" height="175" class="scaleX-n1-rtl" alt="View Badge User">
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Carte utilisateur -->
  <div class="col-12 col-lg-4">
    <div class="card text-center p-4 align-items-center">
      <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('assets/img/avatars/1.png') }}" class="rounded-circle mb-3" width="80" height="80" style="object-fit:cover;">
      <h5 class="mb-1">{{ Auth::user()->username }}</h5>
      <p class="text-muted mb-2">{{ Auth::user()->email }}</p>
      <div class="d-flex justify-content-center gap-3">
        <div>
          <div class="stat-value">{{ $paiments[0]->sum('montant') ?? [] }}fcfa</div>
          <div class="stat-label">Depenses</div>
        </div>
        <div>
          <div class="stat-value">{{ $paiments[1]->sum('montant') ?? [] }}</div>
          <div class="stat-label">Gains</div>
        </div>
      </div>
      <a href="{{ route('tontines-tontines') }}" class="btn btn-sm btn-outline-primary mt-3">Voir mes tontines</a>
    </div>
  </div>

  <!-- Statistiques rapides -->
  <div class="col-12 col-lg-8">
    <div class="row g-4">
      <div class="col-6 col-md-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between mb-4">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded text-muted"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <p class="mb-1">Tontines actives</p>
            <h4 class="card-title mb-3">{{ count($tontine)}}</h4>
            <small class="text-success fw-medium"><i class='bx bx-up-arrow-alt'></i> {{ count($tontine)}}%</small>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between mb-4">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded text-muted"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <p class="mb-1">Solde total</p>
            <h4 class="card-title mb-3">{{  $tontine->sum('contribution_amount') }} FCFA</h4>
            <small class="text-success fw-medium"><i class='bx bx-up-arrow-alt'></i> 47.54%</small>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between mb-4">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded text-muted"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <p class="mb-1">Membres totals</p>
            <h4 class="card-title mb-3">{{ count($tontine)}}</h4>
            <small class="text-success fw-medium"><i class='bx bx-up-arrow-alt'></i> {{ count($tontine)}}%</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Transactions récentes -->
  <div class="col-12 col-lg-6">
    <div class="card h-100">
      <div class="card-header">
        <h5 class="mb-0">Transactions récentes</h5>
      </div>
      <div class="card-body">
        <ul class="list-group">
          @foreach($paiments[0] ?? [] as $paiement)
          <li class="list-group-item d-flex align-items-center">
            <img src="{{ $paiement->utilisateur->image ? asset('storage/' . $paiement->utilisateur->image) : asset('assets/img/avatars/1.png') }}" class="rounded-circle me-3" width="40" height="40" style="object-fit:cover;">
            <div>
              <div><strong>{{ $paiement->utilisateur->username }}</strong> a payé {{ $paiement->montant }} FCFA</div>
              <small class="text-muted">{{ $paiement->created_at->format('d/m/Y H:i') }}</small>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>

  <!-- Tontines actives -->
  <div class="col-12 col-lg-6">
    <div class="card h-100">
      <div class="card-header">
        <h5 class="mb-0">Mes tontines actives</h5>
      </div>
      <div class="card-body">
        <ul class="list-group">
          @foreach($tontine as $tontin)
          <li class="list-group-item">
            <strong>{{ $tontin->name }}</strong>
            <span class="badge bg-primary ms-2">{{ ucfirst($tontin->contribution_frequency) }}</span>
            <div class="text-muted small">Début : {{ $tontin->startDate }}</div>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>

</div>
@endsection