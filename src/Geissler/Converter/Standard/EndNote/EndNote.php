<?php

namespace Geissler\Converter\Standard\EndNote;

use Geissler\Converter\Standard\Basic\StandardAbstract;
use Geissler\Converter\Standard\EndNote\Parser;
use Geissler\Converter\Standard\EndNote\Creator;

/**
 * TODO: Template comment.
 *
 * @author Benjamin Geißler <benjamin.geissler@gmail.com>
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
