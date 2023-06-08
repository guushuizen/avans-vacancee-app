<?php

require_once __DIR__ . '/../models/Model.php';
use PHPUnit\Framework\TestCase;

class ModelsTest extends TestCase
{
    public function test_uuid_uniqueness()
    {
        $length = 1_000_0;

        $generated = array_map(fn() => Model::generateUuid(), range(1, $length));

        $this->assertEquals($length, count((array_unique($generated))));
    }
}
