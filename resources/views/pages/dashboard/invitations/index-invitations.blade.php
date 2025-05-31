@extends('components/contentNavbarLayout')

@section('title', 'Dashboard - invitations')

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

@if(session()->has('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="my-4">
    <span class="app-brand-text demo menu-text fw-bold ms-2 text">Mes invitations</span>
</div>

<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table">
            <caption class="ms-6">Liste des invitations</caption>
            <thead>
                <tr>
                    <th>Expediteur</th>
                    <th>Tontine</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>



                @foreach($invitations as $invitation)
                <tr>
                    <td>{{ $invitation->expediteur->email }}</td>
                    <td>{{ $invitation->tontine->name }}</td>
                    <td>
                        @if ($invitation->statut == 'en_attente' )
                        <span class="badge bg-label-info">en attente</span>
                        @elseif($invitation->statut == 'accepte')
                        <span class="badge bg-label-success">accepté</span>
                        @elseif($invitation->statut == 'refuse')
                        <span class="badge bg-label-danger">refusé</span>
                        @endif
                    </td>
                    <td>{{ $invitation->date_invitation }}</td>

                    @if($invitation->statut == 'en_attente')
                    <td>
                        <div class="container d-flex">
                            <form action="{{ route('invitations.mes.invitations') }}" method="POST">
                                @csrf
                                <input type="hidden" name="tontine_id" value="{{ $invitation->tontine->id }}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="invitation_id" value="{{ $invitation->id }}">
                                <button class="badge badge-center rounded-pill bg-success border-none mx-1" type="submit" value="accepte">
                                    ok
                                </button>
                            </form>

                            <form action="{{ route('invitations.refuse.invitations', $invitation->id) }}" method="POST">
                                @csrf
                                <button class="badge badge-center rounded-pill bg-danger border-none mx-1" type="submit" value="refuse">
                                    no
                                </button>

                            </form>
                        </div>
                    </td>
                    @endif

                    @if($invitation->statut == 'refuse')
                    <td> <del><em>invitation refusée</em></del></td>
                    @elseif($invitation->statut == 'accepte')
                    <td> <del><em>invitation acceptée</em></del></td>
                    @endif




                </tr>
                @endforeach


            </tbody>
        </table>
    </div>
</div>

@endsection