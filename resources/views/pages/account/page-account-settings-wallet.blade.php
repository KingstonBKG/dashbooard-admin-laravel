@extends('components/contentNavbarLayout')

@section('title', 'Account settings - Pages')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="nav-align-top">
            <ul class="nav nav-pills flex-column flex-md-row mb-6">
                <li class="nav-item"><a class="nav-link" href="{{route('account-settings-account')}}"><i class="bx bx-user bx-sm me-1_5"></i> Account</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('account-settings-notifications')}}"><i class="bx bx-sm bx-bell me-1_5"></i> Notifications</a></li>
                <li class="nav-item"><a class="nav-link " href="{{route('account-settings-connections')}}"><i class="bx bx-link-alt bx-sm me-1_5"></i> Connections</a></li>
                <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-sm bx-money me-1_5"></i> Portefeuille </a></li>
            </ul>
        </div>
        <div class="card">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="card-header">
                        <h5 class="mb-1">Vos portefeuilles</h5>
                        <p class="my-0 card-subtitle">Gérer facilement vos portefeuilles dans {{config('variables.appName')}}</p>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger mx-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="card mx-5">
                        <h5 class="card-header text-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#smallModal">
                                <span class="tf-icons bx bx-plus bx-18px me-2"></span>
                                Nouveau portefeuille
                            </button>
                        </h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <caption class="ms-6">Liste des portefeuilles</caption>
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>montant</th>
                                        <th>devise</th>
                                        <th>statut</th>
                                        <th>Crée le </th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wallets as $wallet)
                                    <tr>
                                        <td>
                                            {{ $wallet->type }}
                                        </td>
                                        <td>
                                            {{ $wallet->montant }}
                                        </td>
                                        <td>
                                            {{ $wallet->devise }}
                                        </td>
                                        <td>
                                            @if ($wallet->is_active == 1 )
                                            <span class="badge bg-label-info">actif</span>
                                            @elseif($invitation->statut == 2)
                                            <span class="badge bg-label-danger">désactivé</span>

                                            @endif
                                        </td>
                                        <td>
                                            {{ $wallet->created_at }}
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded text-muted"></i>
                                                </button>

                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">

                                                    <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#depositWalletModal{{ $wallet->id }}">
                                                        <i class="bx bx-plus me-1"></i>
                                                        <span class="m-l-10">Déposer</span>
                                                    </button>
                                                    
                                                    <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#retrieveWalletModal{{ $wallet->id }}">
                                                        <i class="bx bx-minus me-1"></i>
                                                        <span class="m-l-10">Rétirer</span>
                                                    </button>

                                                    <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#deleteWalletModal{{ $wallet->id }}">
                                                        <i class="bx bx-trash me-1"></i>
                                                        <span class="m-l-10">Supprimer</span>
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

                    <div class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel2">Nouveau Portefeuille</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('wallet.wallet.store') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" id="user_id" class="form-control" value="{{ Auth::user()->id }}" name="user_id">
                                        <div class="row">
                                            <div class="col mb-6">
                                                <label for="type" class="form-label">Type</label>
                                                <input type="text" id="type" class="form-control" placeholder="Epargne, decouverte" name="type">
                                            </div>
                                        </div>
                                        <div class="row g-6">
                                            <div class="col mb-0">
                                                <label class="form-label" for="montant">Montant</label>
                                                <input type="number" class="form-control" id="montant" placeholder="50000" name="montant">
                                            </div>
                                            <div class="col mb-0">
                                                <label for="devise" class="form-label">Devise</label>
                                                <input id="devise" type="text" class="form-control" name="devise" placeholder="XAF, Euro, Dollar">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-info  mx-4">
                                        <i class="bx bx-info-circle me-1"></i>
                                        un portefeuille ne peut être supprimé que si son montant est égale à 0. Contactez-nous en cas de besoin. <a href="mailto:test@gmail.com">test@gmail.com</a>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>




                    <!-- Modal suppression -->
                    @foreach ($wallets as $wallet)
                    <div class="modal fade" id="deleteWalletModal{{ $wallet->id }}" tabindex="-1"
                        aria-labelledby="deleteWalletModalLabel" aria-hidden="true">
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
                                            <h5>Êtes-vous sûr de vouloir supprimer ce portefeuille ?</h5>
                                            <p class="mb-0">
                                                <strong>Portefeuille #{{ $wallet->id }}</strong> - <strong>{{ $wallet->type }}</strong>


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
                                    <form action="{{ route('wallet.wallet.destroy', $wallet->id) }}" method="POST"
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

                    <!-- Modal deposit -->
                    @foreach ($wallets as $wallet)
                    <div class="modal fade" id="depositWalletModal{{ $wallet->id }}" tabindex="-1"
                        aria-labelledby="depositWalletModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info text-white justify-content-between">
                                    <h5 class="modal-title" id="deleteTontineModalLabel">
                                        <i class="anticon anticon-exclamation-circle"></i> Déposer
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                </div>
                                <form action="{{ route('wallet.wallet.destroy', $wallet->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('UPDATE')
                                    <div class="modal-body">
                                        <div class="row">
                                                <div class=" mb-6">
                                                    <label for="type" class="form-label">Montant</label>
                                                    <input type="number" id="montant" class="form-control" placeholder="min. 1000" name="montant">
                                                </div>
                                            </div>

                                        <div class="alert alert-warning">
                                            <i class="anticon anticon-warning"></i>
                                            <strong>NB :</strong> Bien vouloir vérifier que la demande de retrait est émise par nos services.
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                                            <i class="bx bx-close me-1"></i> Annuler
                                        </button>
                                        <button type="submit" class="btn btn-info">
                                            <i class="bx bx-plus me-1"></i> Confirmer
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- Modal retrieve -->
                    @foreach ($wallets as $wallet)
                    <div class="modal fade" id="retrieveWalletModal{{ $wallet->id }}" tabindex="-1"
                        aria-labelledby="retrieveWalletModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info text-white justify-content-between">
                                    <h5 class="modal-title" id="retrieveTontineModalLabel">
                                        <i class="anticon anticon-exclamation-circle"></i> Retirer
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                </div>
                                <form action="{{ route('wallet.wallet.destroy', $wallet->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('UPDATE')
                                    <div class="modal-body">
                                        <div class="row">
                                                <div class=" mb-6">
                                                    <label for="type" class="form-label">Montant</label>
                                                    <input type="number" id="montant" class="form-control" placeholder="min. 1000" name="montant">
                                                </div>
                                            </div>

                                        <div class="alert alert-warning">
                                            <i class="anticon anticon-warning"></i>
                                            <strong>NB :</strong> Bien vouloir vérifier que les demande de retraits sont émises par nos services.
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                                            <i class="bx bx-close me-1"></i> Annuler
                                        </button>
                                        <button type="submit" class="btn btn-info">
                                            <i class="bx bx-plus me-1"></i> Confirmer
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
@endsection