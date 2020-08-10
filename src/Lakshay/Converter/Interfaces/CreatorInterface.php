<?php
namespace Lakshay\Converter\Interfaces;

use Lakshay\Converter\Model\Entries;

/**
 * Create a valid standard entry based on a given \Lakshay\Converter\Model\Entries object.
 *
 * @author Benjamin Geißler <benjamin.lakshay@gmail.com>
 * @license MIT
 */
interface CreatorInterface
{
    /**
     * Create entries based on the given standard from the \Lakshay\Converter\Model\Entries object.
     *
     * @param \Lakshay\Converter\Model\Entries $data
     * @return boolean
     */
    public function create(Entries $data);

    /**
     * Retrieve the created standard data. Return false if standard could not be created.
     *
     * @return string|boolean
     */
    public function retrieve();
}
