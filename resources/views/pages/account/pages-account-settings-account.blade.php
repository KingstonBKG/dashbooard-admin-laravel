@extends('components/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
@vite(['resources/assets/js/pages-account-settings-account.js'])
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="nav-align-top">
      <ul class="nav nav-pills flex-column flex-md-row mb-6">
        <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-sm bx-user me-1_5"></i> Account</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('account-settings-notifications')}}"><i class="bx bx-sm bx-bell me-1_5"></i> Notifications</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('account-settings-connections')}}"><i class="bx bx-sm bx-link-alt me-1_5"></i> Connections</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('account-settings-wallet')}}"><i class="bx bx-sm bx-money me-1_5"></i> Portefeuille </a></li>

      </ul>
    </div>
    <div class="card mb-6">


      <div class="card-body pt-4">
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        @if(session()->has('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif

        <form id="formAccountSettings" method="POST" enctype="multipart/form-data" action="{{ route('account.settings.account.update', $user->id) }}">
          @csrf
          @method('PUT')
          <!-- Account -->
          <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
              <img src="/storage/{{old('image', $user->image)}}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded-pill objet-fit-cover" id="uploadedAvatar" />
              <div class="button-wrapper">

                <label for="image" class="btn btn-primary me-3 mb-4" tabindex="0">
                  <span class="d-none d-sm-block">Mettre à jour l'image</span>
                  <i class="bx bx-upload d-block d-sm-none"></i>
                  <input type="file" id="image" class="account-file-input" name="image" hidden accept="image/png, image/jpeg" />
                </label>

                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                  <i class="bx bx-reset d-block d-sm-none"></i>
                  <span class="d-none d-sm-block">Réinitinisaliser</span>
                </button>

                <div>Autorisé JPG, GIF or PNG. Taille maximum 2mo</div>
              </div>
            </div>
          </div>

          <div class="row g-6">
            <div class="col-md-6">
              <label for="username" class="form-label">Nom utilisateur</label>
              <input class="form-control @error('username') is-invalid @enderror" type="text" id="username" name="username" value="{{old('username', $user->username)}}" autofocus />
            </div>
            <div class="col-md-6">
              <label for="password_confirmation" class="form-label">Nouveau mot de passe <span class="text-red">( Laissez vide si vous ne voulez pas changer )</span></label>
              <input class="form-control @error('password_confirmation') is-invalid @enderror" type="text" name="password_confirmation" id="password_confirmation" placeholder="" />
            </div>
            <div class="col-md-6">
              <label for="password" class="form-label">Confimer le nouveau mot de passe <span class="text-red">( Laissez vide si vous ne voulez pas changer )</span></label>
              <input class="form-control @error('password') is-invalid @enderror" type="text" name="password" id="password" placeholder="" />
            </div>
            <div class="col-md-6">
              <label for="organization" class="form-label">Organization</label>
              <input type="text" class="form-control" id="organization" name="organization" value="{{old('organization', $user->organization)}}" />
            </div>
            <div class="col-md-6">
              <label class="form-label" for="phoneNumber">Phone Number</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text">CM (+237)</span>
                <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" placeholder="202 555 0111" value="{{old('phoneNumber', $user->phoneNumber)}}" />
              </div>
            </div>
            <div class="col-md-6">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{old('address', $user->address)}}" />
            </div>

            <div class="col-md-6">
              <label class="form-label" for="country">Pays</label>
              <select id="country" class="select2 form-select" name="country">
                <option value="">-- Selectionner --</option>
                <option value="Australia">Australia</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Belarus">Belarus</option>
                <option value="Brazil">Brazil</option>
                <option value="Canada">Canada</option>
                <option value="China">China</option>
                <option value="France">France</option>
                <option value="Germany">Germany</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Japan">Japan</option>
                <option value="Korea">Korea, Republic of</option>
                <option value="Mexico">Mexico</option>
                <option value="Philippines">Philippines</option>
                <option value="Russia">Russian Federation</option>
                <option value="South Africa">South Africa</option>
                <option value="Thailand">Thailand</option>
                <option value="Turkey">Turkey</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="language" class="form-label">Langage</label>
              <select id="language" name="language" class="select2 form-select">
                <option value="">-- Selectionner --</option>
                <option value="en">English</option>
                <option value="fr">Français</option>
                <option value="de">German</option>
                <option value="pt">Portuguese</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="timeZones" class="form-label">Fuseau horaire</label>
              <select id="timeZones" class="select2 form-select" name="timeZones">
                <option value="">-- Selectionner --</option>
                <option value="-12">(GMT-12:00) International Date Line West</option>
                <option value="-11">(GMT-11:00) Midway Island, Samoa</option>
                <option value="-10">(GMT-10:00) Hawaii</option>
                <option value="-9">(GMT-09:00) Alaska</option>
                <option value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
                <option value="-8">(GMT-08:00) Tijuana, Baja California</option>
                <option value="-7">(GMT-07:00) Arizona</option>
                <option value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                <option value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
                <option value="-6">(GMT-06:00) Central America</option>
                <option value="-6">(GMT-06:00) Central Time (US & Canada)</option>
                <option value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                <option value="-6">(GMT-06:00) Saskatchewan</option>
                <option value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                <option value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
                <option value="-5">(GMT-05:00) Indiana (East)</option>
                <option value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                <option value="-4">(GMT-04:00) Caracas, La Paz</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="currency" class="form-label">Currency</label>
              <select id="currency" name="currency" class="select2 form-select">
                <option value="">-- Selectionner --</option>
                <option value="usd">USD</option>
                <option value="euro">Euro</option>
                <option value="pound">Pound</option>
                <option value="bitcoin">Bitcoin</option>
              </select>
            </div>
          </div>
          <div class="mt-6">
            <button type="submit" class="btn btn-primary me-3">Save changes</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
    <div class="card">
      <h5 class="card-header">Delete Account</h5>
      <div class="card-body">
        <div class="mb-6 col-12 mb-0">
          <div class="alert alert-warning">
            <h5 class="alert-heading mb-1">Are you sure you want to delete your account?</h5>
            <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
          </div>
        </div>
        <form id="formAccountDeactivation" onsubmit="return false">
          <div class="form-check my-8 ms-2">
            <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
            <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
          </div>
          <button type="submit" class="btn btn-danger deactivate-account" disabled>Deactivate Account</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection