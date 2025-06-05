@extends('components/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

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
<div class="row">
  <div class="col-xxl-8 mb-6 order-0">
    <div class="card">
      <div class="d-flex align-items-start row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary mb-3">Congratulations {{ Auth::user()->username }}! 🎉</h5>
            <p class="mb-6">You have done 72% more sales today.<br>Check your new badge in your profile.</p>

            <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-6">
            <img src="{{asset('assets/img/illustrations/man-with-laptop.png')}}" height="175" class="scaleX-n1-rtl" alt="View Badge User">
          </div>
        </div>
      </div>
    </div>
  </div>
  

  <!-- Expense Overview -->
  <div class="col-md-6 col-lg-4 order-1 mb-6">
    <div class="card h-100">
      <div class="card-header nav-align-top">
        <ul class="nav nav-pills" role="tablist">
          <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tabs-line-card-income" aria-controls="navs-tabs-line-card-income" aria-selected="true">Income</button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab">Expenses</button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab">Profit</button>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content p-0">
          <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
            <div class="d-flex mb-6">
              <div class="avatar flex-shrink-0 me-3">
                <img src="{{asset('assets/img/icons/unicons/wallet.png')}}" alt="User">
              </div>
              <div>
                <p class="mb-0">Total Balance</p>
                <div class="d-flex align-items-center">
                  <h6 class="mb-0 me-1">$459.10</h6>
                  <small class="text-success fw-medium">
                    <i class='bx bx-chevron-up bx-lg'></i>
                    42.9%
                  </small>
                </div>
              </div>
            </div>
            <div id="incomeChart"></div>
            <div class="d-flex align-items-center justify-content-center mt-6 gap-3">
              <div class="flex-shrink-0">
                <div id="expensesOfWeek"></div>
              </div>
              <div>
                <h6 class="mb-0">Income this week</h6>
                <small>$39k less than last week</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Expense Overview -->

  <!-- Transactions -->
  <div class="col-md-6 col-lg-4 order-2 mb-6">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Transactions</h5>
        <div class="dropdown">
          <button class="btn text-muted p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded bx-lg"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
          </div>
        </div>
      </div>
      <div class="card-body pt-4">
        <ul class="p-0 m-0">
          <li class="d-flex align-items-center mb-6">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/unicons/paypal.png')}}" alt="User" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <small class="d-block">Paypal</small>
                <h6 class="fw-normal mb-0">Send money</h6>
              </div>
              <div class="user-progress d-flex align-items-center gap-2">
                <h6 class="fw-normal mb-0">+82.6</h6> <span class="text-muted">USD</span>
              </div>
            </div>
          </li>
          <li class="d-flex align-items-center mb-6">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/unicons/wallet.png')}}" alt="User" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <small class="d-block">Wallet</small>
                <h6 class="fw-normal mb-0">Mac'D</h6>
              </div>
              <div class="user-progress d-flex align-items-center gap-2">
                <h6 class="fw-normal mb-0">+270.69</h6> <span class="text-muted">USD</span>
              </div>
            </div>
          </li>
          <li class="d-flex align-items-center mb-6">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/unicons/chart.png')}}" alt="User" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <small class="d-block">Transfer</small>
                <h6 class="fw-normal mb-0">Refund</h6>
              </div>
              <div class="user-progress d-flex align-items-center gap-2">
                <h6 class="fw-normal mb-0">+637.91</h6> <span class="text-muted">USD</span>
              </div>
            </div>
          </li>
          <li class="d-flex align-items-center mb-6">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/unicons/cc-primary.png')}}" alt="User" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <small class="d-block">Credit Card</small>
                <h6 class="fw-normal mb-0">Ordered Food</h6>
              </div>
              <div class="user-progress d-flex align-items-center gap-2">
                <h6 class="fw-normal mb-0">-838.71</h6> <span class="text-muted">USD</span>
              </div>
            </div>
          </li>
          <li class="d-flex align-items-center mb-6">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/unicons/wallet.png')}}" alt="User" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <small class="d-block">Wallet</small>
                <h6 class="fw-normal mb-0">Starbucks</h6>
              </div>
              <div class="user-progress d-flex align-items-center gap-2">
                <h6 class="fw-normal mb-0">+203.33</h6> <span class="text-muted">USD</span>
              </div>
            </div>
          </li>
          <li class="d-flex align-items-center">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{asset('assets/img/icons/unicons/cc-warning.png')}}" alt="User" class="rounded">
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <small class="d-block">Mastercard</small>
                <h6 class="fw-normal mb-0">Ordered Food</h6>
              </div>
              <div class="user-progress d-flex align-items-center gap-2">
                <h6 class="fw-normal mb-0">-92.45</h6> <span class="text-muted">USD</span>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!--/ Transactions -->

 
</div>
<!--/ Calendrier des paiements -->
</div>

@endsection
