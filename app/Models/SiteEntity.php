<?php

namespace App\Models;

use App\Models\AbstractModel;

class SiteEntity extends AbstractModel
{
    const PRIMARY_KEY = 'id';
    
    protected $casts = [
        'data' => 'json',
    ];
}