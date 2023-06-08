<?php

require_once __DIR__ . '/../models/Vacature.php';
use PHPUnit\Framework\TestCase;

class VacaturesTest extends TestCase
{
    public function test_vacature_lange_beschrijving()
    {
        $vacature = new Vacature(
            "foo",
            "Software Engineer",
            "Morbi nec nunc maximus, volutpat lectus quis, eleifend metus. Donec faucibus nisi dignissim tellus tincidunt vestibulum eget sit amet tortor. Proin faucibus tincidunt ipsum nec vestibulum. Curabitur rhoncus justo eu iaculis rhoncus. Donec vitae volutpat quam. Mauris malesuada, mauris ut malesuada vestibulum, risus ipsum mattis nibh, vitae laoreet augue eros maximus ex. In gravida rutrum quam non pellentesque. Vivamus in neque odio. Cras sollicitudin neque ut nisi condimentum, id interdum nisl sollicitudin. Quisque rutrum et augue id luctus. Aliquam sed neque condimentum, posuere erat non, placerat arcu. Pellentesque rutrum, lectus ut imperdiet vehicula, enim nunc tempor ipsum, sit amet sollicitudin metus justo a nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer eu pulvinar tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer justo mi, volutpat a velit tincidunt, varius finibus nulla.",
            4000,
        );

        $this->assertEquals("Morbi nec nunc maximus, volutpat lectus quis, elei...", $vacature->korteBeschrijving());
    }

    public function test_vacature_korte_beschrijving()
    {
        $vacature = new Vacature(
            "foo",
            "Software Engineer",
            "Kom hier werken!!!",
            4000,
        );

        $this->assertEquals("Kom hier werken!!!", $vacature->korteBeschrijving());
    }
}
