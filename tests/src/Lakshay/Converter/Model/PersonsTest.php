<?php
namespace Lakshay\Converter\Model;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-03-01 at 15:58:26.
 */
class PersonsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Persons
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Persons;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Lakshay\Converter\Model\Persons::setPerson
     * @covers Lakshay\Converter\Model\Container::setData
     */
    public function testSetPerson()
    {
        $this->assertInstanceOf('\Lakshay\Converter\Model\Persons', $this->object->setPerson(new Person()));
    }

    /**
     * @covers Lakshay\Converter\Model\Container::getIterator
     */
    public function testGetIterator()
    {
        $this->assertInstanceOf('\ArrayIterator', $this->object->getIterator());
        $this->assertInstanceOf('\Lakshay\Converter\Model\Persons', $this->object->setPerson(new Person()));
        $this->assertInstanceOf('\Lakshay\Converter\Model\Persons', $this->object->setPerson(new Person()));

        foreach ($this->object as $person) {
            $this->assertInstanceOf('\Lakshay\Converter\Model\Person', $person);
        }
    }
}