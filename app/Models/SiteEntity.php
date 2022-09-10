<?php

namespace Zevitagem\LaravelSaasTemplateCore\Models;

use Zevitagem\LaravelSaasTemplateCore\Models\AbstractModel;

class SiteEntity extends AbstractModel
{
    const PRIMARY_KEY = 'id';
    
    protected $casts = [
        'data' => 'json',
    ];
}