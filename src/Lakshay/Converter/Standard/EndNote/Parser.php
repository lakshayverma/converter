<?php

namespace Lakshay\Converter\Standard\EndNote;

use Lakshay\Converter\Interfaces\ParserInterface;
use Lakshay\Converter\Model\Entries;
use Lakshay\Converter\Model\Entry;
use Lakshay\Converter\Model\Person;
use Lakshay\Converter\Model\Date;

/**
 * TODO: Parser comment.
 *
 * @author Benjamin Geißler <benjamin.lakshay@gmail.com>
 * @license MIT
 */
class Parser implements ParserInterface
{
    /**
     * Transfer the data from a standard into a \Lakshay\Converter\Model\Entries object.
     *
     * @param string $data
     * @return boolean
     */
    public function parse($data)
    {
        // TODO: Implement parse() method.
    }

    /**
     * Retrieve the \Lakshay\Converter\Model\Entries object containing the parsed data.
     *
     * @throws \ErrorException when no entries object is set.
     *
     * @return \Lakshay\Converter\Model\Entries
     */
    public function retrieve()
    {
        // TODO: Implement retrieve() method.
    }
}
