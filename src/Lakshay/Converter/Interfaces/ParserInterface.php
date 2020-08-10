<?php
namespace Lakshay\Converter\Interfaces;

use Lakshay\Converter\Model\Entries;

/**
 * Transfer entries of a standard into a \Lakshay\Converter\Model\Entries object.
 *
 * @author Benjamin Geißler <benjamin.geissler@gmail.com>
 * @license MIT
 */
interface ParserInterface
{
    /**
     * Transfer the data from a standard into a \Lakshay\Converter\Model\Entries object.
     *
     * @param string $data
     * @return boolean
     */
    public function parse($data);

    /**
     * Retrieve the \Lakshay\Converter\Model\Entries object containing the parsed data.
     *
     * @throws \ErrorException when no entries object is set.
     * @return \Lakshay\Converter\Model\Entries
     */
    public function retrieve();
}
