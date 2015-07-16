<?php

namespace Tifon\Rut;

/**
 * RutProvider contains helper methods for processing Rut.
 *
 * @author Nicolas Moncada <moncada.nicolas@gmail.com>.
 */
class RutUtil
{
    /**
     * Helps separate the RUT.
     * @param string $value
     *   It is the complete RUT.
     *
     * @return array
     *   Returns the RUT without dots or dash and the DV separately.
     */
    static public function separateRut($value) {
        $completeRut = str_replace(array('.', '-'), array('', ''), $value);

        return array(
            substr($completeRut, 0, -1),
            substr($completeRut, -1),
        );
    }

    /**
     * This validate the RUT.
     *
     * @param mixed $rut
     *   Corresponds to the rut. Can be the all Rut or without the check
     *   digit but it must be added to the $dv variable.
     * @param mixed $dv
     *   Corresponds to a character, it can be a number from 0-9 or "k". This
     *   is optional if not set will try get the dv from the $rut variable.
     *
     * @return bool
     *   If the RUT is valid.
     */
    static public function validateRut($rut, $dv = NULL) {
        if (is_null($dv)) {
            list($rut, $dv) = self::separateRut($rut);
        }

        if (!is_numeric($rut)) {
            return FALSE;
        }

        $_dv = self::calculateDv($rut);
        if ($_dv == trim(strtolower($dv))) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Calculate de DV from the RUT.
     *
     * @param int $rut
     *   Corresponds the RUT without the check digit.
     *
     * @return string
     *   The check digit.
     */
    static public function calculateDv($rut) {
        $rut = (string) $rut;
        $sum = 0;
        $factor = 2;
        for ($i = strlen($rut) - 1; $i >= 0; $i--) {
            $factor = $factor > 7 ? 2 : $factor;
            $sum += $rut{$i} * $factor++;
        }
        $rest = $sum % 11;
        $_dv = 11 - $rest;
        if ($_dv == 11) {
            $_dv = 0;
        }
        elseif ($_dv == 10) {
            $_dv = "k";
        }

        return $_dv;
    }

    /**
     * Formatting RUT.
     *
     * @param mixed $rut
     *   Corresponds the RUT without format. Can be without the check digit.
     * @param mixed $dv
     *   Corresponds to a character, it can be a number from 0-9 or "k". This
     *   is optional if not set will try get the dv from the $rut variable.
     *
     * @return string
     *   Corresponds the RUT with format.
     */
    static public function formatterRut($rut, $dv = NULL, $withDots = TRUE) {
        if (is_null($dv)) {
            list($rut, $dv) = self::separateRut($rut);
        }
        if (self::validateRut($rut, $dv)) {
            if ($withDots) {
                return number_format($rut, 0, '', '.') . '-' . $dv;
            }

            return $rut . '-' . $dv;
        }

        return '';
    }

    /**
     * Method to randomly generate a valid RUT.
     *
     * @param boolean $formatted
     *   Defines if the the return value comes with the rut format.
     * @param integer $min
     *   The minimum value.
     * @param integer $max
     *   The maximum value.
     *
     * @return mixed
     *   The new RUT with format or in an array.
     */
    static function generateRut($formatted = TRUE, $min = 1, $max = 20000000) {
        $rut = rand($min, $max);
        $dv = self::calculateDv($rut);

        if ($formatted) {

            return self::formatterRut($rut, $dv);
        }

        return array($rut, $dv);
    }
}