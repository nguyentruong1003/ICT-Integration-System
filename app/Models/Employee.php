<?php

namespace App\Models;

use App\Enums\EMasterData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Employee extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = "employee";

    public function department() {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater() {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function position() {
        return $this->belongsTo(MasterData::class, 'position_id');
    }
}
