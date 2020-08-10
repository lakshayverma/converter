<?php

namespace Lakshay\Converter\Standard\EndNote;

use Lakshay\Converter\Standard\Basic\StandardAbstract;
use Lakshay\Converter\Standard\EndNote\Parser;
use Lakshay\Converter\Standard\EndNote\Creator;

/**
 * TODO: Template comment.
 *
 * @author Benjamin Geißler <benjamin.lakshay@gmail.com>
 * @license MIT
 */
class EndNote extends StandardAbstract
{
    /**
     * Constructor.
     *
     * @param string $data The data to parse.
     */
    public function __construct($data = '')
    {
        parent::__construct($data);
        $this->setParser(new Parser());
        $this->setCreator(new Creator());
    }
}
