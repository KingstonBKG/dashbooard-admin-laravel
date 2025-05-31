<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tontine extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'contribution_amount',
        'contribution_frequency',
        'max_members',
        'type',
        'description',
        'startDate',
        'admin_id',
        'status',
        'current_pot'
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function membres()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function assignRole($role)
    {
        $this->role = $role;
        $this->save();
    }
}
