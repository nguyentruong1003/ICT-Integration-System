<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Department extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = "departments";
    protected $fillable = [
        'editId',
        'name',
        'code',
        'description',
        'leader_id',
        'note',
        'created_by',
        'status',
    ];

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getLeaderName() {
        return $this->belongsTo(Employee::class, 'leader_id');
    }
}
