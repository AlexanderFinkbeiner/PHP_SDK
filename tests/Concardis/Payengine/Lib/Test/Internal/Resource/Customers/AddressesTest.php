<?php
namespace Concardis\Payengine\Lib\Test\Internal\Resource\Customers;

require_once __DIR__ . "/../../../../../../../../autoload.php";

use Concardis\Payengine\Lib\Internal\Config\MerchantConfiguration;
use Concardis\Payengine\Lib\Internal\Connection\Connection;
use Concardis\Payengine\Lib\Models\Response\ListWrapper;
use Concardis\Payengine\Lib\PayEngine;
use Concardis\Payengine\Lib\Test\Fixture\Model\AddressFixture;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class AddressesTest
 * @package Concardis\Payengine\Lib\Test\Internal\Resource\Customers
 */
class AddressesTest extends TestCase
{
    /**
     * @var PayEngine
     */
    private $payengine;

    public function setup() : void {
        $this->payengine = new PayEngine(new MerchantConfiguration());
        $this->payengine->setConnection($this->getConnectionMock());
    }

    protected function getConnectionMock() : Connection| MockObject
    {
        $mock = $this->createMock(Connection::class);

        $mock->method('post')
            ->willReturn(AddressFixture::getResponse()->__toArray());
        return $mock;
    }

    public function testPostTest(){
        $result = $this->payengine->customer('test123')->addresses()->post(array());
        $this->assertEquals(AddressFixture::getResponse(), $result);
    }


    public function testGetOneTest(){
        $mock = $this->createMock(Connection::class);
        $mock->method('get')
            ->with('/customers/test123/addresses/foobar123')
            ->willReturn(AddressFixture::getResponse()->__toArray());
        $this->payengine->setConnection($mock);

        $result = $this->payengine->customer('test123')->addresses('foobar123')->get();

        $this->assertInstanceOf('\Concardis\Payengine\Lib\Models\Response\Customers\Address', $result);
        $this->assertEquals(AddressFixture::getResponse(), $result);
    }

    public function testGetAllTest(){
        $mock = $this->createMock(Connection::class);
        $mock->method('get')
            ->with('/customers/test123/addresses')
            ->willReturn(
                array(
                    'totalPages' => 2,
                    'elements' => array(
                        AddressFixture::getResponse()->__toArray(),
                        AddressFixture::getResponse()->__toArray()
                    )
                
        ));
        $this->payengine->setConnection($mock);

        $result = $this->payengine->customer('test123')->addresses()->get();
        $this->assertTrue(is_a($result, ListWrapper::class));
        $this->assertEquals(2, $result->getTotalPages());
        $this->assertEquals(2, count($result->getElements()));

        $this->assertTrue(is_array($result->getElements()));
        foreach($result->getElements() as $element){
            $this->assertEquals(AddressFixture::getResponse(), $element);
        }
    }
}