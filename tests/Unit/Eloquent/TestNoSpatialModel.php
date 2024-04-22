<?php

namespace Tests\Unit\Eloquent;

use Illuminate\Database\Eloquent\Model;

class TestNoSpatialModel extends Model
{
    use \Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
}