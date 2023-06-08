<?php

require_once __DIR__ . '/../models/Gebruiker.php';
require_once __DIR__ . '/../controllers/carrieresites/CreateController.php';
use PHPUnit\Framework\TestCase;

class GebruikersTest extends TestCase
{
    public function test_gebruiker_volle_naam()
    {
        $gebruiker = new Gebruiker(
            "Guus",
            "Huizen",
            "GuusOnline",
            "guus@guus.tech",
            "0613682945",
            "foo"
        );

        $this->assertEquals("Guus Huizen", $gebruiker->volleNaam());
    }

    public function test_authenticate()
    {
        $gebruiker = new Gebruiker(
            "Guus",
            "Huizen",
            "GuusOnline",
            "guus@guus.tech",
            "0613682945",
            "foo"
        );

        $this->assertTrue($gebruiker->authenticate("foo"));
        $this->assertFalse($gebruiker->authenticate("bar"));
    }
}
