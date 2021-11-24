<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Unit extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function father_unit() {
        return $this->belongsTo(Unit::class, 'father_id');
    }
}
