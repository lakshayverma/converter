<?php
namespace Lakshay\Converter\Model;

use Lakshay\Converter\Model\Container;
use Lakshay\Converter\Model\Entry;

/**
 * Group of literature entries as "array"-object.
 *
 * @author Benjamin Geißler <benjamin.geissler@gmail.com>
 * @license MIT
 */
class Entries extends Container
{
    /**
     * Add a new literature entry.
     *
     * @param Entry $entry
     * @return Entries
     */
    public function setEntry(Entry $entry)
    {
        return $this->setData($entry);
    }
}
