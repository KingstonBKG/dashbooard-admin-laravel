@extends('components/contentNavbarLayout')

@section('title', 'Account settings - Pages')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="nav-align-top">
      <ul class="nav nav-pills flex-column flex-md-row mb-6">
        <li class="nav-item"><a class="nav-link" href="{{route('account-settings-account')}}"><i class="bx bx-user bx-sm me-1_5"></i> Account</a></li>
        <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-bell bx-sm me-1_5"></i> Notifications</a></li>
        <!-- <li class="nav-item"><a class="nav-link" href="{{route('account-settings-connections')}}"><i class="bx bx-link-alt bx-sm me-1_5"></i> Connections</a></li> -->
        <li class="nav-item"><a class="nav-link" href="{{route('account-settings-wallet')}}"><i class="bx bx-sm bx-money me-1_5"></i> Portefeuille </a></li>
      </ul>
    </div>
    <div class="card">
      <!-- Notifications -->
      <div class="card-body">
        <h5 class="mb-1">Notifications récentes</h5>
        <span class="card-subtitle">Consultez l'ensemble des notifications lié à votre compte </span>
        <div class="error"></div>
      </div>

      <div class="card-body">
        <h6 class="text-body mb-6">Voulez-vous recevoir des notifications</h6>
        <form action="{{route('account.settings.notifications', $user->id)}}" method="POST">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-sm-6">
              <select id="sendNotification" class="form-select" name="sendNotification">
                <option selected value="1">Oui, je veux recevoir des notifications (recommandé)</option>
                <option value="2">Non, pas du tout</option>
              </select>
            </div>
            <div class="mt-6">
              <button type="submit" class="btn btn-primary me-3">Sauvegarder</button>
              <button type="reset" class="btn btn-outline-secondary">Discard</button>
            </div>
          </div>
        </form>
      </div>

      <div class="mx-6 mb-4">
        <small class="text-light fw-medium">Vos notifications</small>
        <div class="mt-4">
          <div class="list-group">
            @foreach ($user->notifications as $notification)
            <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex justify-content-between w-100">
                <h5 class="mb-1">{{ $notification->data['title'] }}</h5>
                <small>{{ $notification->created_at }}</small>
              </div>
              <p class="mb-1">{{ $notification->data['message'] }}</p>
              <small>Donec id elit non mi porta.</small>
            </a>
            @endforeach

          </div>
        </div>
      </div>



    </div>

    <!-- /Notifications -->
  </div>
</div>
</div>
@endsection