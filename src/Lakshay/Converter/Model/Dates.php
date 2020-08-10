<?php
namespace Lakshay\Converter\Model;

use Lakshay\Converter\Model\Container;
use Lakshay\Converter\Model\Date;

/**
 * Group of dates (Lakshay\Converter\Model\Date).
 *
 * @author Benjamin Geißler <benjamin.geissler@gmail.com>
 * @license MIT
 */
class Dates extends Container
{
    /**
     * Adda a new Lakshay\Converter\Model\Date object.
     *
     * @param Date $date
     * @return Container
     */
    public function setDate(Date $date)
    {
        return $this->setData($date);
    }
}
