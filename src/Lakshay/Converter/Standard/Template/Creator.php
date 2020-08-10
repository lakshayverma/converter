<?php
namespace Lakshay\Converter\Standard\Template;

use Lakshay\Converter\Interfaces\CreatorInterface;
use Lakshay\Converter\Model\Entries;
use Lakshay\Converter\Model\Persons;

/**
 * TODO: Creator comment.
 *
 * @author  Benjamin Geißler <benjamin.lakshay@gmail.com>
 * @license MIT
 */
class Creator implements CreatorInterface
{
    /**
     * Create entries based on the given standard from the \Lakshay\Converter\Model\Entries object.
     *
     * @param \Lakshay\Converter\Model\Entries $data
     * @return boolean
     */
    public function create(Entries $data)
    {
        // TODO: Implement create() method.
    }

    /**
     * Retrieve the created standard data. Return false if standard could not be created.
     *
     * @return string|boolean
     */
    public function retrieve()
    {
        // TODO: Implement retrieve() method.
    }
}
