<?php

namespace App\Models;

use App\Models\Daily;
use App\Models\Party;
use App\Models\Process;
use App\Models\Repair;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dimond extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function parties()
    {
        return $this->belongsTo(Party::class);
    }

    public function process()
    {
        return $this->hasOne(Process::class, 'dimonds_id')->latest();
    }

    public function processes()
    {
        return $this->hasMany(Process::class, 'dimonds_id');
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class, 'dimonds_id');
    }

    public function dailies()
    {
        return $this->hasMany(Daily::class, 'dimonds_id');
    }
}
