<?php
namespace Lakshay\Converter\Standard\Basic;

use Lakshay\Converter\Interfaces\FormattingStandard;
use Lakshay\Converter\Interfaces\ParserInterface;
use Lakshay\Converter\Interfaces\CreatorInterface;
use Lakshay\Converter\Model\Entries;

/**
 * A basic class which each standard must extend by injecting a parser and creator object via the setter methods in
 * it's constructor.
 *
 * @author Benjamin Geißler <benjamin.geissler@gmail.com>
 * @license MIT
 */
abstract class StandardAbstract implements FormattingStandard
{
    /** @var \Lakshay\Converter\Model\Entries */
    private $entries;
    /** @var string */
    private $data;
    /** @var \Lakshay\Converter\Interfaces\ParserInterface */
    private $parser;
    /** @var \Lakshay\Converter\Interfaces\CreatorInterface */
    private $creator;

    /**
     * Constructor.
     *
     * @param string $data The data to parse.
     */
    public function __construct($data = '')
    {
        $this->data     =   $data;
    }

    /**
     * Transfers the given data or via constructor injected data into an Entries object.
     *
     * @param string $data
     * @return boolean
     */
    public function parse($data = '')
    {
        if ($data !== '') {
            $this->data =   $data;
        }

        if ($this->getParser()->parse($this->data) == true) {
            $this->entries  =   $this->getParser()->retrieve();
            return true;
        }

        return false;
    }

    /**
     * Retrieve the generated \Lakshay\Converter\Model\Entries object.
     *
     * @throws \ErrorException when no entries object is set.
     * @return \Lakshay\Converter\Model\Entries
     */
    public function retrieve()
    {
        if (isset($this->entries) == true) {
            return $this->entries;
        }

        throw new \ErrorException('No entries object set! Has the data been parsed?');
    }

    /**
     * Transfer the data from the \Lakshay\Converter\Model\Entries object into valid entries of the given
     * standard.
     *
     * @param \Lakshay\Converter\Model\Entries $data
     * @return string
     */
    public function create(Entries $data)
    {
        if ($this->getCreator()->create($data) == true) {
            return $this->getCreator()->retrieve();
        }

        return '';
    }

    /**
     * Inject the creator object.
     *
     * @param \Lakshay\Converter\Interfaces\CreatorInterface $creator
     * @return \Lakshay\Converter\Standard\Basic\StandardAbstract
     */
    protected function setCreator(CreatorInterface $creator)
    {
        $this->creator = $creator;
        return $this;
    }

    /**
     * Access the creator object.
     *
     * @throws \ErrorException when the creator object is missing
     * @return \Lakshay\Converter\Interfaces\CreatorInterface
     */
    protected function getCreator()
    {
        if (isset($this->creator) == true) {
            return $this->creator;
        }

        throw new \ErrorException('Error! Missing creator object!');
    }

    /**
     * Inject the parser object.
     *
     * @param \Lakshay\Converter\Interfaces\ParserInterface $parser
     * @return \Lakshay\Converter\Standard\Basic\StandardAbstract
     */
    protected function setParser(ParserInterface $parser)
    {
        $this->parser = $parser;
        return $this;
    }

    /**
     * Access the parser object.
     *
     * @throws \ErrorException when the parser object is not injected
     * @return \Lakshay\Converter\Interfaces\ParserInterface
     */
    protected function getParser()
    {
        if (isset($this->parser) == true) {
            return $this->parser;
        }

        throw new \ErrorException('Error! Missing parser object!');
    }
}
