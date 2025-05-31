@extends('components/contentNavbarLayout')

@section('title', 'Tontines Archivées')

@section('content')

@if (session()->has('success'))
<div class="alert alert-primary alert-dismissible" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    </button>
</div>
@endif

<div class="card">
    <h5 class="card-header">Tontines Archivées</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Montant</th>
                    <th>Fréquence</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tontines as $tontine)
                <tr>
                    <td>{{ $tontine->name }}</td>
                    <td>{{ $tontine->contribution_amount }}</td>
                    <td>{{ $tontine->contribution_frequency }}</td>
                    <td><span class="badge bg-label-warning">Archivée</span></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <form action="{{ route('tontines.restore', $tontine->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bx bx-recycle me-1"></i> Restaurer
                                    </button>
                                </form>
                                <form action="{{ route('tontines.forcedelete', $tontine->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bx bx-trash me-1"></i> Supprimer définitivement
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection