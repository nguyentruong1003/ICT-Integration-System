<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class MasterData extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'master_data';
    protected $guarded = ['*'];
    protected $fillable = [
        'type',
        'key',
        'order',
        'value',
        'url',
        'note'
    ];

    public $timestamps = false;
}
