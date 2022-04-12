<?php

namespace Grimzy\LaravelMysqlSpatial\Types;

class Factory implements \GeoIO\Factory
{
    public function createPoint($dimension, array $coordinates, $srid = null): Point
    {
        return new Point($coordinates['y'], $coordinates['x']);
    }

    public function createLineString($dimension, array $points, $srid = null): LineString
    {
        return new LineString($points);
    }

    public function createLinearRing($dimension, array $points, $srid = null): LineString
    {
        return new LineString($points);
    }

    public function createPolygon($dimension, array $lineStrings, $srid = null): Polygon
    {
        return new Polygon($lineStrings);
    }

    public function createMultiPoint($dimension, array $points, $srid = null): MultiPoint
    {
        return new MultiPoint($points);
    }

    public function createMultiLineString($dimension, array $lineStrings, $srid = null): MultiLineString
    {
        return new MultiLineString($lineStrings);
    }

    public function createMultiPolygon($dimension, array $polygons, $srid = null): MultiPolygon
    {
        return new MultiPolygon($polygons);
    }

    public function createGeometryCollection($dimension, array $geometries, $srid = null): GeometryCollection
    {
        return new GeometryCollection($geometries);
    }
}
