@extends('components/contentNavbarLayout')

@section('title', 'Dashboard - Tontines')

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

@if (session()->has('success'))
<div class="alert alert-primary alert-dismissible" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    </button>
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

<div class="my-4">
    <span class="app-brand-text demo menu-text fw-bold ms-2 text">Mes tontines</span>
</div>

<div class="col-lg-4 col-md-4 order-1">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-6 mb-6">
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
                    <p class="mb-1">Profit</p>
                    <h4 class="card-title mb-3">$12,628</h4>
                    <small class="text-success fw-medium"><i class='bx bx-up-arrow-alt'></i> +72.80%</small>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-6 mb-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0">
                            <img src="{{asset('assets/img/icons/unicons/wallet-info.png')}}" alt="wallet info" class="rounded">
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded text-muted"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div>
                    </div>
                    <p class="mb-1">Sales</p>
                    <h4 class="card-title mb-3">$4,679</h4>
                    <small class="text-success fw-medium"><i class='bx bx-up-arrow-alt'></i> +28.42%</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <h5 class="card-header text-end">
        <a href="{{ route('tontines-archived') }}" class="btn btn-secondary me-2">
            <span class="tf-icons bx bx-archive-in bx-18px me-2"></span>
            Archives
        </a>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exLargeModal">
            <span class="tf-icons bx bx-plus bx-18px me-2"></span>
            Nouvelle Tontine
        </button>
    </h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <caption class="ms-6">Liste des tontines</caption>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Contribution</th>
                    <th>Membres</th>
                    <th>Type</th>
                    <th>Fréquence</th>
                    <th>status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach($tontines as $tontine)
                <tr>
                    <td><i class="bx bxl-react bx-md text-info me-4"></i> {{ $tontine->name }}</td>
                    <td>{{ $tontine->contribution_amount }} FCFA</td>

                    <td>
                        <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                            @foreach ($tontine->membres as $membre)
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="{{ $membre->username }}">
                                <img src="/storage/{{ $membre->image }}" alt="Avatar" class="rounded-circle">
                            </li>
                            @endforeach
                            total {{ $tontine->membres->count() }}
                        </ul>
                    </td>
                    <td>{{ $tontine->type }}</td>
                    <td>{{ $tontine->contribution_frequency }}</td>
                    <td><span class="badge bg-label-primary me-1">{{ $tontine->status }}</span></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" type="button" href="{{ route('tontine-view-main', $tontine->id) }}">
                                    <i class="bx bx-log-in me-1"></i>
                                    <span class="m-l-10">Entrer</span>
                                </a>
                                @can('delete', $tontine)
                                <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                    data-bs-target="#invitationTontineModal{{ $tontine->id }}">
                                    <i class="bx bx-plus me-1"></i>
                                    <span class="m-l-10">Ajouter un membre</span>
                                </button>
                                <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                    data-bs-target="#modificationModal{{ $tontine->id }}">
                                    <i class="bx bx-edit me-1"></i>
                                    <span class="m-l-10">Mettre à jour</span>
                                </button>
                                <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                    data-bs-target="#deleteTontineModal{{ $tontine->id }}">
                                    <i class="bx bx-trash me-1"></i>
                                    <span class="m-l-10">Supprimer</span>
                                </button>
                                @endcan

                                <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                    data-bs-target="#detailsTontineModal{{ $tontine->id }}">
                                    <i class="bx bx-show me-1"></i>
                                    <span class="m-l-10">Details</span>
                                </button>


                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>













<!-- modal ajout -->
<div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel4">Créer une tontine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('my.tontine') }}" method="POST">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nom de la tontine</label>
                            <input type="text" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Entrer le nom de la tontine"
                                value="{{ old('name') }}">

                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="type" class="form-label">Type de tontine</label>
                            <select id="type" name="type" class="form-select @error('type') is-invalid @enderror">
                                <option value="">Sélectionner un type</option>
                                <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Fixe</option>
                                <option value="rotating" {{ old('type') == 'rotating' ? 'selected' : '' }}>Rotative</option>
                                <option value="voting" {{ old('type') == 'voting' ? 'selected' : '' }}>Par vote</option>
                            </select>
                            @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description"
                                class="form-control @error('description') is-invalid @enderror"
                                rows="3">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="contribution_amount" class="form-label">Montant de la contribution</label>
                            <input type="number" id="contribution_amount" name="contribution_amount"
                                class="form-control @error('contribution_amount') is-invalid @enderror"
                                value="{{ old('contribution_amount') }}">
                            @error('contribution_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="contribution_frequency" class="form-label">Fréquence de contribution</label>
                            <select id="contribution_frequency" name="contribution_frequency"
                                class="form-select @error('contribution_frequency') is-invalid @enderror">
                                <option value="">Sélectionner une fréquence</option>
                                <option value="weekly" {{ old('contribution_frequency') == 'weekly' ? 'selected' : '' }}>Hebdomadaire</option>
                                <option value="bi_weekly" {{ old('contribution_frequency') == 'bi_weekly' ? 'selected' : '' }}>Bi-hebdomadaire</option>
                                <option value="monthly" {{ old('contribution_frequency') == 'monthly' ? 'selected' : '' }}>Mensuelle</option>
                                <option value="yearly" {{ old('contribution_frequency') == 'yearly' ? 'selected' : '' }}>Annuelle</option>
                            </select>
                            @error('contribution_frequency')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="max_members" class="form-label">Nombre maximum de membres</label>
                            <input type="number" id="max_members" name="max_members"
                                class="form-control @error('max_members') is-invalid @enderror"
                                value="{{ old('max_members') }}" min="2">
                            @error('max_members')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Date de début</label>
                            <input type="date" id="startDate" name="startDate"
                                class="form-control @error('startDate') is-invalid @enderror"
                                value="{{ old('startDate') }}">
                            @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    
                     <div class="row mb-4">

                        <div class="col-md-6">
                            <label for="random_draw" class="form-label">Type de tirage</label>
                            <select id="random_draw" name="random_draw"
                                class="form-select @error('random_draw') is-invalid @enderror">
                                <option value="">Sélectionner un tirage</option>
                                <option value="0" {{ old('random_draw') == '0' ? 'selected' : '' }}>manuelle</option>
                                <option value="1" {{ old('random_draw') == '1' ? 'selected' : '' }}>aléatoire</option>
                            </select>
                            @error('contribution_frequency')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    

                    <input type="hidden" id="admin_id" name="admin_id"
                        class="form-control @error('admin_id') is-invalid @enderror"
                        value="{{ Auth::user()->id }}">
                    @error('admin_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary mx-4" data-bs-dismiss="modal">Annuler</button>

                        <button type="submit" class="btn btn-primary">Créer la tontine</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal modification -->
@foreach ($tontines as $tontine)
<div class="modal fade" id="modificationModal{{ $tontine->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel4">Modifier cette tontine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('tontines-modify', $tontine->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nom de la tontine</label>
                            <input type="text" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Entrer le nom de la tontine"
                                value="{{ old('name', $tontine->name) }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="type" class="form-label">Type de tontine</label>
                            <select id="type" name="type" class="form-select @error('type') is-invalid @enderror">
                                <option value="">Sélectionner un type</option>
                                <option value="fixed" {{ old('type', $tontine->type) == 'fixed' ? 'selected' : '' }}>Fixe</option>
                                <option value="rotating" {{ old('type', $tontine->type) == 'rotating' ? 'selected' : '' }}>Rotative</option>
                                <option value="voting" {{ old('type', $tontine->type) == 'voting' ? 'selected' : '' }}>Par vote</option>
                            </select>
                            @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description"
                                class="form-control @error('description') is-invalid @enderror"
                                rows="3">{{ old('description', $tontine->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="contribution_amount" class="form-label">Montant de la contribution</label>
                            <input type="number" id="contribution_amount" name="contribution_amount"
                                class="form-control @error('contribution_amount') is-invalid @enderror"
                                value="{{ old('contribution_amount', $tontine->contribution_amount) }}">
                            @error('contribution_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="contribution_frequency" class="form-label">Fréquence de contribution</label>
                            <select id="contribution_frequency" name="contribution_frequency"
                                class="form-select @error('contribution_frequency') is-invalid @enderror">
                                <option value="">Sélectionner une fréquence</option>
                                <option value="weekly" {{ old('contribution_frequency', $tontine->contribution_frequency) == 'weekly' ? 'selected' : '' }}>Hebdomadaire</option>
                                <option value="bi_weekly" {{ old('contribution_frequency', $tontine->contribution_frequency) == 'bi_weekly' ? 'selected' : '' }}>Bi-hebdomadaire</option>
                                <option value="monthly" {{ old('contribution_frequency', $tontine->contribution_frequency) == 'monthly' ? 'selected' : '' }}>Mensuelle</option>
                                <option value="yearly" {{ old('contribution_frequency', $tontine->contribution_frequency) == 'yearly' ? 'selected' : '' }}>Annuelle</option>
                            </select>
                            @error('contribution_frequency')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="max_members" class="form-label">Nombre maximum de membres</label>
                            <input type="number" id="max_members" name="max_members"
                                class="form-control @error('max_members') is-invalid @enderror"
                                value="{{ old('max_members', $tontine->max_members) }}" min="2">
                            @error('max_members')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Date de début</label>
                            <input type="date" id="startDate" name="startDate"
                                class="form-control @error('startDate') is-invalid @enderror"
                                value="{{ old('startDate', $tontine->startDate) }}">
                            @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                            <label for="random_draw" class="form-label">Type de tirage</label>
                            <select id="random_draw" name="random_draw" class="form-select @error('random_draw') is-invalid @enderror">
                                <option value="">Sélectionner un tirage</option>
                                <option value='0' {{ old('random_draw', $tontine->random_draw) == '0' ? 'selected' : '' }}>manuelle</option>
                                <option value='1' {{ old('random_draw', $tontine->random_draw) == '1' ? 'selected' : '' }}>aleatoire</option>
                            </select>
                            @error('random_draw')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    <input type="hidden" id="admin_id" name="admin_id"
                        class="form-control @error('admin_id') is-invalid @enderror"
                        value="{{ Auth::user()->id }}">
                    @error('admin_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary mx-4" data-bs-dismiss="modal">Annuler</button>

                        <button type="submit" class="btn btn-warning">Modifier la tontine</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


<!-- Modal suppression -->
@foreach ($tontines as $tontine)
<div class="modal fade" id="deleteTontineModal{{ $tontine->id }}" tabindex="-1" aria-labelledby="deleteTontineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white justify-content-between">
                <h5 class="modal-title" id="deleteTontineModalLabel">
                    <i class="anticon anticon-exclamation-circle"></i> Confirmation de suppression
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center mb-4">
                    <div class="mr-3">
                        <i class="bx bx-trash me-1 text-danger" style="font-size: 2rem;"></i>
                    </div>
                    <div>
                        <h5>Êtes-vous sûr de vouloir supprimer cette Tontine ?</h5>
                        <p class="mb-0">
                            <strong>Tontine #{{ $tontine->id }}</strong> - <strong>{{ $tontine->name }}</strong>

                            <br>
                            <small class="text-muted">
                                Date de début: {{ \Carbon\Carbon::parse($tontine->startDate)->format('d/m/Y') }} |
                                Nombre de membre: {{ $tontine->membres->count() }} |
                                statut : @if($tontine->status == 'active') Actif
                                @else
                                Terminé
                                @endif
                            </small>
                        </p>
                    </div>
                </div>

                <div class="alert alert-warning">
                    <i class="anticon anticon-warning"></i>
                    <strong>Attention :</strong> Cette action est irréversible. Toutes les données associées
                    (documents, historiques)
                    seront définitivement supprimées.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                    <i class="bx bx-close me-1"></i> Annuler
                </button>
                <form action="{{ route('tontine.destroy', $tontine->id) }}" method="POST"
                    class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bx bx-trash me-1"></i> Confirmer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


<!-- Modal invitation -->
@foreach ($tontines as $tontine)
<div class="modal fade" id="invitationTontineModal{{ $tontine->id }}" tabindex="-1"
    aria-labelledby="invitationTontineModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white justify-content-between">
                <h5 class="modal-title">
                    <i class="bx bx-user-plus"></i> Ajouter un nouveau membre
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group input-group-merge mb-3">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input type="text" class="form-control search-user"
                        placeholder="Rechercher par email..."
                        aria-label="Search...">
                </div>

                <div class="card my-4" style="max-height: 400px; overflow-y: auto;">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Nom</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users->take(10) as $user)
                                @if($user->id !== Auth::id())
                                <tr class="user-row" data-email="{{ $user->email }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $user->image ? '/storage/'.$user->image : asset('assets/img/avatars/1.png') }}"
                                                alt="Avatar" class="rounded-circle me-2" style="width: 32px; height: 32px;">
                                            {{ $user->email }}
                                        </div>
                                    </td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        @php
                                        $invitation = \App\Models\Invitation::where('tontine_id', $tontine->id)
                                        ->where('destinataire_email', $user->email)
                                        ->first();
                                        @endphp

                                        @if($invitation)
                                        <button class="btn btn-secondary btn-sm" disabled>
                                            <i class="bx bx-check"></i> Déjà invité
                                        </button>
                                        @else
                                        <form action="{{ route('invitations.send', $tontine->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="expediteur_id" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="destinataire_email" value="{{ $user->email }}">
                                            <input type="hidden" name="tontine_id" value="{{ $tontine->id }}">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="bx bx-envelope"></i> Inviter
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="alert alert-info">
                    <i class="bx bx-info-circle me-1"></i>
                    Seuls les 10 premiers utilisateurs sont affichés. Utilisez la recherche pour trouver une personne spécifique.
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal details -->

@foreach ($tontines as $tontine)
<div class="modal fade" id="detailsTontineModal{{ $tontine->id }}" tabindex="-1" aria-labelledby="detailsTontineModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white justify-content-betwee">
                <h5 class="modal-title text-white">
                    <i class="anticon anticon-info-circle"></i> Détails de la tontine
                    <span class="highlight">#{{ $tontine->name }}</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="section">
                    <p><strong>Type :</strong> {{ $tontine->type }}</p>
                    <p><strong>Contribution :</strong>

                        @foreach ($tontine->tontinewallet as $wallet)
                        <span class="badge bg-label-info"> {{ $wallet->type }}: {{ number_format($wallet->montant, 0, ',', ' ') }} FCFA
                        </span>
                        @endforeach

                    </p>
                    <p><strong>Fréquence :</strong> {{ $tontine->contribution_frequency }}
                    </p>
                    <p><strong>Statut :</strong>
                        <span class="status active">Actif</span>
                    </p>
                    <p><strong>Date de création :</strong> {{ \Carbon\Carbon::parse($tontine->created_at)->format('d M Y') }}</p>
                </div>

                <hr>

                <div class="section">
                    <h5>Membres ({{ count($tontine->membres) }})</h5>
                    <div class="member-grid">
                        @foreach ($tontine->membres as $membre)
                        <div class="member">
                            <img src="/storage/{{ $membre->image }}" class="avatar" alt="{{ $membre->username }}">
                            <span class="name">{{ $membre->username }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Place ce style dans ton layout ou au début du fichier Blade -->
<style>
    .member-grid {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .member {
        display: flex;
        flex-direction: column;
        align-items: center;
        font-size: 0.9rem;
    }

    .member .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 4px;
    }

    .status.active {
        color: #4CAF50;
        font-weight: bold;
    }
</style>


@endforeach



@push('page-script')


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInputs = document.querySelectorAll('.search-user');

        searchInputs.forEach(input => {
            input.addEventListener('keyup', function() {
                const searchValue = this.value.toLowerCase();
                const modalId = this.closest('.modal').id;
                const rows = document.querySelectorAll(`#${modalId} .user-row`);

                rows.forEach(row => {
                    const email = row.getAttribute('data-email').toLowerCase();
                    if (email.includes(searchValue)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endpush
@endsection