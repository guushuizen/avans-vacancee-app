<?php

require_once __DIR__ . '/../models/Carrieresite.php';
use PHPUnit\Framework\TestCase;

class CarrieresiteTest extends TestCase
{
    public function test_carrieresite_domain_name()
    {
        $careersite = new Carrieresite(
            "foo", "bar", "baz", "foo", "image.png"
        );

        $this->assertSame("foo.phpunit.test/", $careersite->publicUrl());
    }

    public function test_base64_encoding()
    {
        $careersite = new Carrieresite(
            "foo",
            "bar",
            "baz",
            "foo",
            dirname(__FILE__) . "/resources/1x1_#000000FF.png" # Generated using https://shoonia.github.io/1x1/#000000ff
        );

        $this->assertEquals(
            "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAAaADAAQAAAABAAAAAQAAAAD5Ip3+AAAADUlEQVQIHWNgYGD4DwABBAEAHnOcQAAAAABJRU5ErkJggg==",
            $careersite->getLogoAsBase64()
        );
    }
}
