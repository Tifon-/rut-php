<?php

use Tifon\Rut\RutUtil;

/**
 * RutUtil test case.
 */
class RutUtilTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test RutUtil::separateRut() with valid and invalid rut.
     *
     * The separateRut does not discriminate if the value is a valid or invalid
     * Rut.
     */
    public function testSeparateRut()
    {
        $rut = '11.111.111-1';
        $separate = RutUtil::separateRut($rut);
        $this->assertTrue(count($separate) == 2);

        $this->assertEquals('11111111', $separate[0]);
        $this->assertEquals('1', $separate[1]);

        $rutInvalid = 'asAf__fd-.asd-';
        $separate = RutUtil::separateRut($rutInvalid);
        $this->assertTrue(count($separate) == 2);

        $this->assertEquals('asAf__fdas', $separate[0]);
        $this->assertEquals('d', $separate[1]);
    }

    /**
     * Test RutUtil::formatterRut() with valid and invalid rut.
     */
    public function testFormatterRut()
    {
        $completeRutWithoutFormater = 111111111;
        $completeRutFormatter = RutUtil::formatterRut($completeRutWithoutFormater);
        $this->assertEquals('11.111.111-1', $completeRutFormatter);

        $completeRutFormatterWithoutDots = RutUtil::formatterRut($completeRutWithoutFormater, NULL, FALSE);
        $this->assertEquals('11111111-1', $completeRutFormatterWithoutDots);

        $completeRutFormatter = RutUtil::formatterRut(11111111, 1);
        $this->assertEquals('11.111.111-1', $completeRutFormatter);
    }

    /**
     * Test RutUtil::validateRut() with valid and invalid rut.
     */
    public function testValidateRut()
    {
        $validRut = '11.111.111-1';
        $this->assertTrue(RutUtil::validateRut($validRut));

        $invalidRut = '11.111.111-2';
        $this->assertFalse(RutUtil::validateRut($invalidRut));
    }

    /**
     * Test RutUtil::generateRut() to generate only valid rut.
     */
    public function testGenerateRut()
    {
        // Testing five random values.
        for ($i = 0; $i < 5; $i++) {
            $rut = RutUtil::generateRut(TRUE, 10000000, 70000000);
            $this->assertTrue(RutUtil::validateRut($rut));
        }
    }
}
