<?php
namespace Lakshay\Converter\Standard\RIS;

use Lakshay\Converter\Standard\Basic\StandardAbstract;
use Lakshay\Converter\Standard\RIS\Parser;
use Lakshay\Converter\Standard\RIS\Creator;

/**
 * RIS (Research Information System).
 *
 * @author Benjamin Geißler <benjamin.geissler@gmail.com>
 * @license MIT
 * @see http://en.wikipedia.org/wiki/RIS_(file_format)
 */
class RIS extends StandardAbstract
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
