<?php

use Tifon\Rut\Rut;

/**
 * Rut test case.
 */
class RutTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     * @var Rut
     */
    private $rut;

    public function setUp()
    {
        $this->rut = new Rut('11.111.111-1');
    }

    /**
     * Test the different way to create a Rut Object.
     */
    public function testRutConstruct()
    {
        $rut1 = new Rut('11.111.111-1');
        $rut2 = new Rut(11111111, 1);

        $this->assertEquals($rut1->getRaw(), $rut2->getRaw());
    }

    /**
     * Test the getter methods.
     */
    public function testRutGetter()
    {
        $rut = $this->rut;

        $this->assertEquals('11111111', $rut->getRut());
        $this->assertEquals('1', $rut->getDv());
        $this->assertEquals('11.111.111-1', $rut->getFormatter());
        $this->assertEquals('11111111-1', $rut->getFormatter(FALSE));
        $this->assertEquals('111111111', $rut->getRaw());
    }

    /**
     * Test the setter methods.
     */
    public function testRutSetter()
    {
        $rut = $this->rut;
        // 1-9 is a valid Rut.
        $rut->setRut(1);
        $rut->setDv(9);

        $this->assertEquals('19', $rut->getRaw());
    }

    /**
     * Test Rut->isValid();
     */
    public function testRutIsValid()
    {
        $rut = $this->rut;

        $this->assertTrue($rut->isValid());

        // Invalid Rut.
        $rut->setDv(2);
        $this->assertFalse($rut->isValid());
    }
}
