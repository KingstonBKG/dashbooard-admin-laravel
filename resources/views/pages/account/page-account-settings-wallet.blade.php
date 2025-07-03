@extends('components/contentNavbarLayout')

@section('title', 'Account settings - Pages')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="nav-align-top">
            <ul class="nav nav-pills flex-column flex-md-row mb-6">
                <li class="nav-item"><a class="nav-link" href="{{route('account-settings-account')}}"><i class="bx bx-user bx-sm me-1_5"></i> Account</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('account-settings-notifications')}}"><i class="bx bx-sm bx-bell me-1_5"></i> Notifications</a></li>
                <!-- <li class="nav-item"><a class="nav-link " href="{{route('account-settings-connections')}}"><i class="bx bx-link-alt bx-sm me-1_5"></i> Connections</a></li> -->
                <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-sm bx-money me-1_5"></i> Portefeuille </a></li>
            </ul>
        </div>
        <div class="card">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="card-header">
                        <h5 class="mb-1">Vos portefeuilles</h5>
                        <p class="my-0 card-subtitle">Gérer facilement votre portefeuille dans {{config('variables.appName')}}</p>
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

                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible mx-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    @endif

                    <div class="card mx-5 mb-3">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <caption class="ms-6">Votre portefeuile</caption>
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>montant</th>
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
                                            {{ number_format($wallet->montant, 0,'', ' ')  }} FCFA
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


                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

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
                                <form action="{{ route('account.settings.wallet.walletupdate', $wallet->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    <input type="hidden" name="action" value="deposit">
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
                                <form action="{{ route('account.settings.wallet.walletupdate', $wallet->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    <input type="hidden" name="action" value="withdraw">
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