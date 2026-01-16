<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'site_id',
        'status_code',
        'response_time',
    ];

    public function status() {
        return $this->belongsTo(Site::class);
    }
}
