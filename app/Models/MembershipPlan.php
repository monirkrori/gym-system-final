<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class   MembershipPlan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'price', 'duration_month', 'description', 'status'];

    public function packages()
    {
        return $this->hasMany(MembershipPackage::class);
    }

    public function userMemberships()
    {
        return $this->hasMany(UserMembership::class);
    }
}
