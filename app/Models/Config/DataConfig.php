<?php

namespace Zevitagem\LaravelSaasTemplateCore\Models\Config;

use Zevitagem\LaravelSaasTemplateCore\Models\AbstractModel;
use Zevitagem\LaravelSaasTemplateCore\Models\Config\DataAddressConfig;

class DataConfig extends AbstractModel
{
    const PRIMARY_KEY = 'id';

    protected $table = 'slug_config';
    protected $fillable = [
        'slug',
        'facebook',
        'instagram',
        'twitter',
        'youtube'
    ];

    public function getFacebook()
    {
        return $this->facebook;
    }

    public function getInstagram()
    {
        return $this->instagram;
    }

    public function getTwitter()
    {
        return $this->twitter;
    }

    public function getYoutube()
    {
        return $this->youtube;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function addresses()
    {
        return $this->hasMany(DataAddressConfig::class, 'slug_config_id', 'slug');
    }
}
