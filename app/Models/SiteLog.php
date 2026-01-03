<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;


class SiteLog extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'site_log';

    protected $fillable = [
        'log_id',  
        'site_id',
        'data'  
    ];
}
