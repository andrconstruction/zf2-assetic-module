<?php
namespace AsseticBundleTest;

use AsseticBundle;
use Zend\ServiceManager;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-11-17 at 11:53:23.
 */
class FilterManager extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AsseticBundle\FilterManager
     */
    protected $object;

    /**
     * @var ServiceManager\ServiceManager
     */
    protected $service;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->service = new ServiceManager\ServiceManager();
        $this->object = new AsseticBundle\FilterManager();
        $this->object->setServiceLocator($this->service);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {}

    public function testGetServiceLocator() {
        $this->assertSame($this->service, $this->object->getServiceLocator());
    }

    /**
     * @dataProvider getAliasHasFalseProvider
     */
    public function testHasFalse($alias) {
        $this->assertFalse($this->object->has($alias));
    }

    public function getAliasHasFalseProvider() {
        return array(
            'simple' => array(
                '$alias' => 'simpleName',
            ),
            'invalid name' => array(
                '$alias' => '@_simpleName',
            ),
        );
    }

    /**
     * @dataProvider getAliasGetExceptionProvider
     * @expectedException \InvalidArgumentException
     */
    public function testGetException($alias) {
        $this->object->get($alias);
    }

    public function getAliasGetExceptionProvider() {
        return array(
            'no existing' => array(
                '$alias' => 'simpleName',
            ),
            'invalid name' => array(
                '$alias' => '@_simpleName',
            ),
        );
    }

    /**
     * @dataProvider getAliasGetExceptionInstanceProvider
     * @expectedException \InvalidArgumentException
     */
    public function testGetExceptionInstance($alias, $object) {
        $this->service->setService($alias, $object);
        $this->object->get($alias);
    }

    public function getAliasGetExceptionInstanceProvider() {
        return array(
            'simple' => array(
                '$alias' => 'simpleName',
                '$object' => new \stdClass(),
            ),
        );
    }

    /**
     * @dataProvider getAliasGetValidProvider
     */
    public function testGetValid($alias, $object) {
        $this->assertInstanceOf('Assetic\Filter\FilterInterface', $object);
        $this->service->setService($alias, $object);
        $result = $this->object->get($alias);
        $this->assertInstanceOf('Assetic\Filter\FilterInterface', $result);
        $this->assertSame($result, $object);
    }

    public function getAliasGetValidProvider() {
        return array(
            'simple' => array(
                '$alias' => 'simpleName',
                '$object' => $this->getMock('Assetic\Filter\FilterInterface'),
            ),
        );
    }
}
