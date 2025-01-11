<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'calories_per_day','price'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

