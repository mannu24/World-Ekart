<?php

namespace Webkul\Attribute\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Attribute\Contracts\AttributeGroupMap as AttributeGroupMapContract;

class AttributeGroupMap extends Model implements AttributeGroupMapContract
{
    public $timestamps = false;
    public $table = 'attribute_group_mappings';

    protected $fillable = ['attribute_id', 'group_id', 'position'];
}