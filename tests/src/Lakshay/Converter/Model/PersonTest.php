<?php
namespace Lakshay\Converter\Model;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-03-05 at 12:53:15.
 */
class PersonTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Person
     */
    protected $object;
    protected $class = '\Lakshay\Converter\Model\Person';

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Person;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Lakshay\Converter\Model\Person::__construct
     * @covers Lakshay\Converter\Model\Person::setDroppingParticle
     */
    public function testSetDroppingParticle()
    {
        $this->assertInstanceOf($this->class, $this->object->setDroppingParticle('von'));
    }

    /**
     * @covers Lakshay\Converter\Model\Person::getDroppingParticle
     */
    public function testGetDroppingParticle()
    {
        $this->assertInstanceOf($this->class, $this->object->setDroppingParticle('von'));
        $this->assertEquals('von', $this->object->getDroppingParticle());
    }

    /**
     * @covers Lakshay\Converter\Model\Person::setFamily
     */
    public function testSetFamily()
    {
        $this->assertInstanceOf($this->class, $this->object->setFamily('Miller'));
    }

    /**
     * @covers Lakshay\Converter\Model\Person::getFamily
     */
    public function testGetFamily()
    {
        $this->assertInstanceOf($this->class, $this->object->setFamily('Miller'));
        $this->assertEquals('Miller', $this->object->getFamily());
    }

    /**
     * @covers Lakshay\Converter\Model\Person::setFemale
     */
    public function testSetFemale()
    {
        $this->assertInstanceOf($this->class, $this->object->setFemale(false));
    }

    /**
     * @covers Lakshay\Converter\Model\Person::getFemale
     */
    public function testGetFemale()
    {
        $this->assertFalse($this->object->getFemale());
    }

    /**
     * @covers Lakshay\Converter\Model\Person::setGiven
     */
    public function testSetGiven()
    {
        $this->assertInstanceOf($this->class, $this->object->setGiven('John Baptist'));
    }

    /**
     * @covers Lakshay\Converter\Model\Person::getGiven
     */
    public function testGetGiven()
    {
        $this->assertInstanceOf($this->class, $this->object->setGiven('John Baptist'));
        $this->assertEquals('John Baptist', $this->object->getGiven());
    }

    /**
     * @covers Lakshay\Converter\Model\Person::setMale
     */
    public function testSetMale()
    {
        $this->assertInstanceOf($this->class, $this->object->setMale(true));
    }

    /**
     * @covers Lakshay\Converter\Model\Person::getMale
     */
    public function testGetMale()
    {
        $this->assertInstanceOf($this->class, $this->object->setMale(true));
        $this->assertTrue($this->object->getMale());
    }

    /**
     * @covers Lakshay\Converter\Model\Person::setNonDroppingParticle
     */
    public function testSetNonDroppingParticle()
    {
        $this->assertInstanceOf($this->class, $this->object->setNonDroppingParticle('della'));
    }

    /**
     * @covers Lakshay\Converter\Model\Person::getNonDroppingParticle
     */
    public function testGetNonDroppingParticle()
    {
        $this->assertInstanceOf($this->class, $this->object->setNonDroppingParticle('della'));
        $this->assertEquals('della', $this->object->getNonDroppingParticle());
    }

    /**
     * @covers Lakshay\Converter\Model\Person::setSuffix
     */
    public function testSetSuffix()
    {
        $this->assertInstanceOf($this->class, $this->object->setSuffix('jr'));
    }

    /**
     * @covers Lakshay\Converter\Model\Person::getSuffix
     */
    public function testGetSuffix()
    {
        $this->assertInstanceOf($this->class, $this->object->setSuffix('jr'));
        $this->assertEquals('jr', $this->object->getSuffix());
    }
}
