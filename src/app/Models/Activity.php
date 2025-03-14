<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'activity_date', 'target_participants', 'division_id', 'created_by', 'approval_status', 'activity_status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approval()
    {
        return $this->hasOne(Approval::class);
    }

    public function report()
    {
        return $this->hasOne(Report::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
