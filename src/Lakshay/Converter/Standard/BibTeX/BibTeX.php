<?php
namespace Lakshay\Converter\Standard\BibTeX;

use Lakshay\Converter\Standard\Basic\StandardAbstract;
use Lakshay\Converter\Standard\BibTeX\Parser;
use Lakshay\Converter\Standard\BibTeX\Creator;

/**
 * BibTeX.
 *
 * @author Benjamin Geißler <benjamin.geissler@gmail.com>
 * @license MIT
 * @see http://en.wikipedia.org/wiki/BibTeX
 */
class BibTeX extends StandardAbstract
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
