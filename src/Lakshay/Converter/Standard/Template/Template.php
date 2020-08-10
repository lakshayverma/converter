<?php
namespace Lakshay\Converter\Standard\Template;

use Lakshay\Converter\Standard\Basic\StandardAbstract;
use Lakshay\Converter\Standard\Template\Parser;
use Lakshay\Converter\Standard\Template\Creator;

/**
 * TODO: Template comment.
 *
 * @author Benjamin Geißler <benjamin.lakshay@gmail.com>
 * @license MIT
 */
class Template extends StandardAbstract
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
