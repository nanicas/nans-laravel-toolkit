<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AttributesResourceModel;

class AbstractModel extends Model
{
    use AttributesResourceModel;
}
