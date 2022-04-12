<?php

use Grimzy\LaravelMysqlSpatial\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateLocationTable extends Migration
{
    private \Illuminate\Database\Schema\Builder $schema;

    public function __construct()
    {
        $this->schema = app('db')->getSchemaBuilder();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!$this->schema->hasTable('geometry')) {
            $this->schema->create('geometry', function (Blueprint $table) {
                $table->charset = 'utf8mb4';
                $table->collation = 'utf8mb4_unicode_ci';
                $table->increments('id');
                $table->geometry('geo')->default(null)->nullable();
                $table->point('location');  // required to be not null in order to add an index
                $table->lineString('line')->default(null)->nullable();
                $table->polygon('shape')->default(null)->nullable();
                $table->multiPoint('multi_locations')->default(null)->nullable();
                $table->multiLineString('multi_lines')->default(null)->nullable();
                $table->multiPolygon('multi_shapes')->default(null)->nullable();
                $table->geometryCollection('multi_geometries')->default(null)->nullable();
                $table->timestamps();
            });
        }

        if (!$this->schema->hasTable('no_spatial_fields')) {
            $this->schema->create('no_spatial_fields', function (Blueprint $table) {
                $table->increments('id');
                $table->geometry('geometry')->default(null)->nullable();
            });
        }

        if (!$this->schema->hasTable('with_srid')) {
            $this->schema->create('with_srid', function (Blueprint $table) {
                $table->charset = 'utf8mb4';
                $table->collation = 'utf8mb4_unicode_ci';
                $table->increments('id');
                $table->geometry('geo', 3857)->default(null)->nullable();
                $table->point('location', 3857)->default(null)->nullable();
                $table->lineString('line', 3857)->default(null)->nullable();
                $table->polygon('shape', 3857)->default(null)->nullable();
                $table->multiPoint('multi_locations', 3857)->default(null)->nullable();
                $table->multiLineString('multi_lines', 3857)->default(null)->nullable();
                $table->multiPolygon('multi_shapes', 3857)->default(null)->nullable();
                $table->geometryCollection('multi_geometries', 3857)->default(null)->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('geometry');
        $this->schema->dropIfExists('no_spatial_fields');
        $this->schema->dropIfExists('with_srid');
    }
}
