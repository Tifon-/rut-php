<?php

namespace Tifon\Rut;

use Tifon\Rut\RutUtil;

/**
 * Rut contain an especifict rut value.
 *
 * @author Nicolas Moncada <moncada.nicolas@gmail.com>.
 */
class Rut
{
    /**
     * The rut without the check digit.
     * @var integer
     */
    protected $rut = 0;

    /**
     * The check digit.
     * @var mixed
     */
    protected $dv = '';

    /**
     * @todo
     *
     * @param mixed $rut
     * @param string $dv
     */
    public function __construct($rut, $dv = NULL)
    {
        if (is_null($dv)) {
          list($rut, $dv) = RutUtil::separateRut($rut);
        }

        $this->rut = $rut;
        $this->dv = $dv;
    }

    /**
     * Set the rut without check digit.
     *
     * @param integer $rut
     *
     * @return Rut
     */
    public function setRut($rut) {
        $this->rut = $rut;

        return $this;
    }

    /**
     * Set the check digit.
     *
     * @param mixed $dv
     *
     * @return Rut
     */
    public function setDv($dv) {
        $this->dv = $dv;

        return $this;
    }

    /**
     * Get the complete rut with formatter.
     *
     * @param boolean $withDot
     *   Define if get the complete rut with or without dots.
     * @return string
     */
    public function getFormatter($withDot = TRUE)
    {
        return RutUtil::formatterRut($this->rut, $this->dv, $withDot);
    }

    /**
     * Get the complete raw rut without dots and dash.
     *
     * @return string
     */
    public function getRaw()
    {
        return $this->rut . $this->dv;
    }

    /**
     * Get the rut without the check digit.
     *
     * @return mixed
     */
    public function getRut()
    {
        return $this->rut;
    }

    /**
     * Get the check digit.
     *
     * @return string
     */
    public function getDv()
    {
        return $this->dv;
    }

    /**
     * Check if the Rut is valid.
     *
     * @return boolean
     */
    public function isValid()
    {
        return RutUtil::validateRut($this->rut, $this->dv);
    }
}