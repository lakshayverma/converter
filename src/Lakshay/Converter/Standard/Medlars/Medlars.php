<?php

namespace Lakshay\Converter\Standard\Medlars;

use Lakshay\Converter\Standard\Basic\StandardAbstract;
use Lakshay\Converter\Standard\Medlars\Parser;
use Lakshay\Converter\Standard\Medlars\Creator;

/**
 *
 * @author Lakshay Verma <verma_lakshay@live.in>
 * @license MIT
 */
class Medlars extends StandardAbstract
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
