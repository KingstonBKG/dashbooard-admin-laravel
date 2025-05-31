<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasFactory, Notifiable, HasApiTokens;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'username',
    'email',
    'password',
    'image',
    'organization',
    'phoneNumber',
    'address',
    'country',
    'language',
    'timeZones',
    'currency',
    'authorize_notification'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function tontines()
  {
    return $this->belongsToMany(Tontine::class, 'tontine_user', 'user_id')->withTimestamps()->withPivot('role');
  }

  public function tontinesAdmin()
  {
    return $this->hasMany(Tontine::class, 'admin_id');
  }

  public function wallets()
  {
    return $this->hasMany(Wallet::class);
  }

  public function hasRole($tontineId, $role){
    return $this->tontines()->where('tontine_id', $tontineId)->where('role', $role)->exists();
  }

  public function assignRole($tontineId, $role){
    $this->tontines()->attach($tontineId, ['role' => $role]);
  }

  
}
