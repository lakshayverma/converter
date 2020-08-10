<?php
namespace Lakshay\Converter\Standard\JsonSimple;

use Lakshay\Converter\Standard\Basic\StandardAbstract;
use Lakshay\Converter\Standard\JsonSimple\Parser;
use Lakshay\Converter\Standard\JsonSimple\Creator;

/**
 * TODO: JsonSimple comment.
 *
 * @author Benjamin Geißler <benjamin.geissler@gmail.com>
 * @license MIT
 */
class JsonSimple extends StandardAbstract
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
