<?php

namespace Zevitagem\LaravelSaasTemplateCore\Models;

use Illuminate\Database\Eloquent\Model;
use Zevitagem\LaravelSaasTemplateCore\Traits\AttributesResourceModel;

class AbstractModel extends Model
{
    use AttributesResourceModel;
}
