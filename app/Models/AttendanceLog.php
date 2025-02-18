<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'check_in', 'check_out', 'status', 'notes','training_session_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function trainingSession()
    {
        return $this->belongsTo(TrainingSession::class);
    }
}
