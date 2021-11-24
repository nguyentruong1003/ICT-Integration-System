<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Unit extends Model
{
    use HasFactory;

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function father_unit() {
        return $this->belongsTo(Unit::class, 'father_id');
    }
}
