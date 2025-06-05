@php
$isMenu = false;
$navbarHideToggle = false;
$tontineName = $data['tontine']->name;

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

@section("title", $tontineName)

@section('content')

<div class="dashboard-bg py-5">
    <div class="container dashboard-container">
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="welcome-title mb-1">Bienvenue, <span class="fw-bold">{{ Auth::user()->username  }}</span></h2>
                    <div class="d-flex align-items-center gap-3">
                        <div class="mini-progress">
                            <span>Interviews</span>
                            <div class="mini-bar">
                                <div class="mini-bar-fill" style="width: 15%"></div>
                            </div>
                            <span class="mini-bar-label">15%</span>
                        </div>
                        <div class="mini-progress">
                            <span>Hired</span>
                            <div class="mini-bar">
                                <div class="mini-bar-fill" style="width: 15%"></div>
                            </div>
                            <span class="mini-bar-label">15%</span>
                        </div>
                        <div class="mini-progress">
                            <span>Project Time</span>
                            <div class="mini-bar">
                                <div class="mini-bar-fill" style="width: 60%"></div>
                            </div>
                            <span class="mini-bar-label">60%</span>
                        </div>
                        <div class="mini-progress">
                            <span>Output</span>
                            <div class="mini-bar">
                                <div class="mini-bar-fill" style="width: 10%"></div>
                            </div>
                            <span class="mini-bar-label">10%</span>
                        </div>
                    </div>
                </div>
                <div class="dashboard-stats d-flex gap-4">



                    <div class="accordion mt-4" id="accordionExample">
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                                    Paiement
                                </button>
                            </h2>

                            <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <a href="{{ route('paiement-index', $data['tontine']->id) }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="<i class='bx bx-money bx-xs' ></i> <span>Envoyez de l'argent</span>">Cotiser</a>

                                    @can('managemoney', $data['tontine'])
                                    <a href="{{ route('paiement-withdraw', $data['tontine']->id) }}" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="<i class='bx bx-money bx-xs' ></i> <span>Retirer de l'argent</span>">Retirer</a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion mt-4" id="accordionExample">
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="true" aria-controls="accordionOne">
                                    Solde de la tontine
                                </button>
                            </h2>

                            <div id="accordionTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="list-group">
                                        @foreach ($tontinewallets as $wallets)
                                        <a href="javascript:void(0);" class="list-group-item list-group-item-action">{{ $wallets->type }}: {{ number_format($wallets->montant, 0,'', ' ')  }} FCFA</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card p-3 mb-4 h-px-250 dashboard-card" id="me">
                    <div class="container-fluid">
                        <div class="fw-bold text-white">Lora Piterson</div>
                        <div class="mb-2 text-white">UX/UI Designer</div>
                    </div>
                    <div class="badge rounded-pill bg-warning text-dark">$1,200</div>
                </div>
                <div class="card dashboard-card p-4">
                    <small class="text-light fw-medium mb-2">Membres de la tontine</small>

                    @foreach ($data['tontine']->membres as $membres)
                    <div class="d-flex mb-4 align-items-center">
                        <div class="flex-shrink-0">
                            <img src="/storage/{{$membres->image}}" alt="error" class="me-4  rounded-circle w-px-30 h-px-30" height="32">
                        </div>
                        <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                            <div class="mb-sm-0 mb-2">
                                <h6 class="mb-0">{{$membres->username}}</h6>
                                <small>{{$membres->role}}</small>
                            </div>

                            @can('assignrole', $data['tontine'])

                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                    <small class="text-light fw-medium mx-5">Assigner un rôle</small>

                                    <form action="{{ route('tontines.assignrole', [
                                        'user_id' => $membres->id,
                                        'tontine_id' => $data['tontine']->id,
                                    ]) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="role" value="">
                                        <a class="dropdown-item" type="button" href="">
                                            <button type="submit" class="m-l-10 btn btn-primary">aucun role</button>
                                        </a>
                                    </form>

                                    <form action="{{ route('tontines.assignrole', [
                                        'user_id' => $membres->id,
                                        'tontine_id' => $data['tontine']->id,
                                    ]) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="role" value="caissier">
                                        <a class="dropdown-item" type="button" href="">
                                            <button type="submit" class="m-l-10 btn btn-primary">caissier</button>
                                        </a>
                                    </form>

                                    <form action="{{ route('tontines.assignrole', [
                                        'user_id' => $membres->id,
                                        'tontine_id' => $data['tontine']->id,
                                    ]) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="role" value="secretaire">

                                        <a class="dropdown-item" type="button" href="">
                                            <button type="submit" class="m-l-10 btn btn-primary">secretaire</button>
                                        </a>
                                    </form>

                                    <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                        data-bs-target="#detailsTontineModal">
                                        <i class="bx bx-show me-1"></i>
                                        <span class="m-l-10">option 3</span>
                                    </button>


                                </div>
                            </div>
                            @endcan
                        </div>
                    </div>
                    @endforeach

                    <div class="mt-4">
                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalToggle">
                            Voir tous les membres
                        </button>

                        <!-- Modal 1-->
                        <div class="modal fade" id="modalToggle" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalToggleLabel">Modal 1</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Show a second modal and hide this one with the button below.
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" data-bs-target="#modalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Open second modal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /Connections -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card dashboard-card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-bold">Progress</span>
                                    <span class="text-muted small">6.1h</span>
                                </div>
                                <div class="progress-chart mb-2">
                                    <div class="bar-group">
                                        <div class="bar" style="height: 70%"></div>
                                        <div class="bar" style="height: 80%"></div>
                                        <div class="bar" style="height: 55%"></div>
                                        <div class="bar" style="height: 90%"></div>
                                        <div class="bar" style="height: 60%"></div>
                                        <div class="bar" style="height: 75%"></div>
                                        <div class="bar" style="height: 40%"></div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted small">Work Time</span>
                                    <span class="badge bg-light text-dark">2.3m</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100 dashboard-card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="card-title mb-0">
                                    <h5 class="mb-1 me-2">Order Statistics</h5>
                                    <p class="card-subtitle">42.82k Total Sales</p>
                                </div>
                                <div class="dropdown">
                                    <button class="btn text-muted p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded bx-lg"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                        <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-6">
                                    <div class="d-flex flex-column align-items-center gap-1">
                                        <h3 class="mb-1">8,258</h3>
                                        <small>Total Orders</small>
                                    </div>
                                    <div id="orderStatisticsChart"></div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class=" mt-4">
                    <div class="nav-align-top nav-tabs-shadow mb-6">
                        <ul class="nav nav-tabs nav-fill" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true"><span class="d-none d-sm-block"><i class="tf-icons bx bx-home bx-sm me-1_5 align-text-bottom"></i> Home <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger ms-1_5 pt-50">3</span></span><i class="bx bx-home bx-sm d-sm-none"></i></button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile" aria-selected="false"><span class="d-none d-sm-block"><i class="tf-icons bx bx-user bx-sm me-1_5 align-text-bottom"></i> Profile</span><i class="bx bx-user bx-sm d-sm-none"></i></button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-messages" aria-controls="navs-justified-messages" aria-selected="false"><span class="d-none d-sm-block"><i class="tf-icons bx bx-message-square bx-sm me-1_5 align-text-bottom"></i> Messages</span><i class="bx bx-message-square bx-sm d-sm-none"></i></button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                                <p>
                                    Icing pastry pudding oat cake. Lemon drops cotton candy caramels cake caramels sesame snaps powder. Bear
                                    claw
                                    candy topping.
                                </p>
                                <p class="mb-0">
                                    Tootsie roll fruitcake cookie. Dessert topping pie. Jujubes wafer carrot cake jelly. Bonbon jelly-o
                                    jelly-o ice
                                    cream jelly beans candy canes cake bonbon. Cookie jelly beans marshmallow jujubes sweet.
                                </p>
                            </div>
                            <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                                <p>
                                    Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice cream. Gummies
                                    halvah
                                    tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream cheesecake fruitcake.
                                </p>
                                <p class="mb-0">
                                    Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah cotton candy
                                    liquorice caramels.
                                </p>
                            </div>
                            <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                                <p>
                                    Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies cupcake gummi
                                    bears
                                    cake chocolate.
                                </p>
                                <p class="mb-0">
                                    Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet roll icing
                                    sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly jelly-o tart brownie
                                    jelly.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card dashboard-card h-100">
                    <div class="card-body">
                        <h6 class="text-muted">4 dernieres transactions</h6>
                        <div class="card-body">
                            <ul class="p-0 m-0">
                                @foreach ($paiements->take(4) as $paiement)
                                <li class="d-flex align-items-center mb-6">
                                    <div class="avatar flex-shrink-0 me-3">
                                        @if ($paiement->moyen == 'orange_money')
                                        <img src="{{asset('assets/img/icons/unicons/Orange_Money.png')}}" alt="User" class="rounded">
                                        @elseif($paiement->moyen == 'mobile_money')
                                        <img src="{{asset('assets/img/icons/unicons/mobile_money.png')}}" alt="User" class="rounded">
                                        @elseif($paiement->moyen == 'bank_card')
                                        <img src="{{asset('assets/img/icons/unicons/card.png')}}" alt="User" class="rounded">
                                        @endif
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="d-block">{{ $paiement['utilisateur']->username }}</small>
                                            <small class="d-block">
                                                @if ($paiement->moyen == 'orange_money')
                                                Orange Money
                                                @elseif($paiement->moyen == 'mobile_money')
                                                Mobile Money
                                                @elseif($paiement->moyen == 'bank_card')
                                                Carte Bancaire
                                                @endif
                                            </small>
                                            <h6 class="fw-normal mb-0">
                                                @if ($paiement->type == 'deposit')
                                                Dépot d'argent
                                                @elseif ($paiement->type == 'withdraw')
                                                Retrait d'argent
                                                @endif
                                            </h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-2">
                                            @if ($paiement->type == 'deposit')
                                            <h6 class="fw-normal mb-0 text-success">+{{ number_format( $paiement->montant, 0,'', ' ') }}</h6><span class="text-success">FCFA</span>
                                            @elseif ($paiement->type == 'withdraw')
                                            <h6 class="fw-normal mb-0 text-danger">-{{ number_format( $paiement->montant, 0,'', ' ') }}</h6><span class="text-danger">FCFA</span>
                                            @endif
                                        </div>
                                    </div>
                                </li>

                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Total Revenue -->
    <div class="col-12 col-xxl-8 order-2 order-md-3 order-xxl-2 my-6">
        <div class="card mx-6">
            <div class="row row-bordered g-0">
                <div class="col-lg-8">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Total Revenue</h5>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="totalRevenue" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded bx-lg text-muted"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalRevenue">
                                <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                            </div>
                        </div>
                    </div>
                    <div id="totalRevenueChart" class="px-3"></div>
                </div>
                <div class="col-lg-4 d-flex align-items-center">
                    <div class="card-body px-xl-9">
                        <div class="text-center mb-6">
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-primary">
                                    <script>
                                        document.write(new Date().getFullYear() - 1)
                                    </script>
                                </button>
                                <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:void(0);">2021</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">2020</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">2019</a></li>
                                </ul>
                            </div>
                        </div>

                        <div id="growthChart"></div>
                        <div class="text-center fw-medium my-6">62% Company Growth</div>

                        <div class="d-flex gap-3 justify-content-between">
                            <div class="d-flex">
                                <div class="avatar me-2">
                                    <span class="avatar-initial rounded-2 bg-label-primary"><i class="bx bx-dollar bx-lg text-primary"></i></span>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>
                                        <script>
                                            document.write(new Date().getFullYear() - 1)
                                        </script>
                                    </small>
                                    <h6 class="mb-0">$32.5k</h6>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="avatar me-2">
                                    <span class="avatar-initial rounded-2 bg-label-info"><i class="bx bx-wallet bx-lg text-info"></i></span>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>
                                        <script>
                                            document.write(new Date().getFullYear() - 2)
                                        </script>
                                    </small>
                                    <h6 class="mb-0">$41.2k</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<style>
    #me {
        background-image: url('/storage/{{ Auth::user()->image }}');
        background-repeat: no-repeat;
        background-size: cover;
        justify-content: center;
        align-items: flex-end;
        display: flex;
    }

    #me:hover {
        transition: ease-in-out 100ms;
        scale: 1.01;
        cursor: pointer;
    }

    .dashboard-bg {
        background: linear-gradient(to bottom right, #FFFFFF 20%, #C9E4CA 100%);
        min-height: 100vh;
    }

    .dashboard-container {
        max-width: 1200px;
        margin: auto;
    }

    .welcome-title {
        font-size: 1.6rem;
        color: #222;
    }

    .dashboard-stats .stat-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 2px 8px #0001;
        padding: 1rem 1.5rem;
        min-width: 100px;
        text-align: center;
    }

    .stat-value {
        font-size: 2rem;
        color: #696cff;
        font-weight: bold;
    }

    .stat-label {
        font-size: 1rem;
        color: #888;
    }

    .profile-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 8px #0001;
        text-align: center;
    }

    .profile-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #ddd;
        margin: 0 auto;
    }

    .profile-name {
        font-size: 1.1rem;
    }

    .profile-role {
        font-size: 0.95rem;
    }

    .profile-salary {
        font-size: 1rem;
        padding: 0.4em 1em;
    }

    .profile-info-list {
        margin-top: 1.5rem;
    }

    .profile-info-item {
        font-size: 0.95rem;
        color: #555;
        margin-bottom: 0.5rem;
    }

    .dashboard-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 8px #0001;
    }

    .progress-chart .bar-group {
        display: flex;
        align-items: end;
        gap: 6px;
        height: 60px;
    }

    .progress-chart .bar {
        width: 8px;
        background: #696cff;
        border-radius: 4px 4px 0 0;
        transition: height 0.3s;
    }

    .timer-circle {
        width: 120px;
        height: 120px;
        position: relative;
        margin: 0 auto;
    }

    .timer-value {
        left: 0;
        right: 0;
        text-align: center;
    }

    .btn-circle {
        border-radius: 50%;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .calendar-section {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 8px #0001;
        padding: 1rem 1.5rem;
        margin-top: 1.5rem;
    }

    .calendar-header .calendar-month {
        font-size: 1rem;
        padding: 0.2em 0.8em;
        border-radius: 8px;
        background: #f5f6fa;
        color: #888;
        cursor: pointer;
    }

    .calendar-header .calendar-month.active {
        background: #696cff;
        color: #fff;
    }

    .calendar-row {
        display: flex;
        align-items: center;
        margin-bottom: 0.6rem;
    }

    .calendar-time {
        width: 80px;
        color: #888;
        font-size: 0.95rem;
    }

    .calendar-event {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 0.5em 1em;
        flex: 1;
        display: flex;
        align-items: center;
    }

    .event-title {
        font-weight: 500;
    }

    .event-users .event-user-img {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        margin-left: -8px;
        border: 2px solid #fff;
    }

    .onboarding-tasks .list-group-item {
        background: transparent;
        border: none;
        padding: 0.4em 0;
        font-size: 0.98rem;
    }

    .onboarding-tasks input[type="checkbox"] {
        accent-color: #696cff;
    }

    .mini-progress {
        display: flex;
        align-items: center;
        gap: 0.3em;
        font-size: 0.93rem;
    }

    .mini-bar {
        width: 38px;
        height: 6px;
        background: #eee;
        border-radius: 4px;
        margin: 0 0.3em;
        overflow: hidden;
        display: inline-block;
    }

    .mini-bar-fill {
        height: 100%;
        background: #696cff;
        border-radius: 4px;
    }

    .mini-bar-label {
        color: #888;
        font-size: 0.9em;
    }
</style>
@endsection