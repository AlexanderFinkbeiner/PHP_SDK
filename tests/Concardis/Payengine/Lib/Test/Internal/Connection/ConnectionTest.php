<?php

namespace Concardis\Payengine\Lib\Test\Internal\Connection;

require_once __DIR__ . "/../../../../../../../autoload.php";

use Concardis\Payengine\Lib\Internal\Config\MerchantConfiguration;
use Concardis\Payengine\Lib\Internal\Connection\Connection;
use Curl\Curl;
use PHPUnit\Framework\TestCase;

class ConnectionTest extends TestCase
{

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @param bool $returnError
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getCurlMock($returnError = false){
        $mock = $this->createMock(Curl::class);

        if($returnError){
            $mock->method('isSuccess')->willReturn(false);
            $mock->curl_error_message = "testCase";
            $mock->http_status_code = 500;
            $mock->request_headers = array();
            $mock->response_headers = array();
            $mock->response = '{}';
        }else{
            $mock->method('isSuccess')->willReturn(true);
            $mock->response = '{ "key":"value" }';
        }
        return $mock;
    }

    /**
     * Branch test for construct
     */
    public function testConstructTest(){
        $this->assertInstanceOf(get_class(new Connection()), new Connection());
        $this->assertInstanceOf(get_class(new Connection()), new Connection(new Curl()));
    }

    /**
     * Branch test for isLiveMode check
     */
    public function testGetEndpointTest(){
        $config = new MerchantConfiguration();
        $config->setIsLiveMode(true);

        $this->connection = new Connection($this->getCurlMock());
        $this->connection->setMerchantConfig($config);

        $response = $this->connection->delete('test');
        $this->assertArrayHasKey('key', $response);
    }

    public function testPostTest_positive(){
        $this->connection = new Connection($this->getCurlMock(false));
        $this->connection->setMerchantConfig(new MerchantConfiguration());
        $response = $this->connection->post('test', array());
        $this->assertArrayHasKey('key', $response);
    }

    public function testPostTest_negative(){
        $this->expectException(\Concardis\Payengine\Lib\Internal\Exception\PayengineResourceException::class);
        $this->connection = new Connection($this->getCurlMock(true));
        $this->connection->setMerchantConfig(new MerchantConfiguration());
        $this->connection->post('test', array());
    }

    public function testPatchTest_positive(){
        $this->connection = new Connection($this->getCurlMock(false));
        $this->connection->setMerchantConfig(new MerchantConfiguration());
        $response = $this->connection->patch('test', array());
        $this->assertArrayHasKey('key', $response);
    }

    public function testPatchTest_negative(){
        $this->expectException(\Concardis\Payengine\Lib\Internal\Exception\PayengineResourceException::class);
        $this->connection = new Connection($this->getCurlMock(true));
        $this->connection->setMerchantConfig(new MerchantConfiguration());
        $this->connection->patch('test', array());
    }

    public function testDeleteTest_positive(){
        $this->connection = new Connection($this->getCurlMock(false));
        $this->connection->setMerchantConfig(new MerchantConfiguration());
        $response = $this->connection->delete('test');
        $this->assertArrayHasKey('key', $response);
    }

    public function testDeleteTest_negative(){
        $this->expectException(\Concardis\Payengine\Lib\Internal\Exception\PayengineResourceException::class);
        $this->connection = new Connection($this->getCurlMock(true));
        $this->connection->setMerchantConfig(new MerchantConfiguration());
        $this->connection->delete('test');
    }

    public function testGetTest_positive(){
        $this->connection = new Connection($this->getCurlMock(false));
        $this->connection->setMerchantConfig(new MerchantConfiguration());
        $response = $this->connection->get('test');
        $this->assertArrayHasKey('key', $response);
    }

    public function testGetQueryStringTest_positive(){
        $this->connection = new Connection($this->getCurlMock(false));
        $this->connection->setMerchantConfig(new MerchantConfiguration());
        $response = $this->connection->get('test', array('filter' => 1, 'orderBy' => 'test'));
        $this->assertArrayHasKey('key', $response);
    }

    public function testGetTest_negative(){
        $this->expectException(\Concardis\Payengine\Lib\Internal\Exception\PayengineResourceException::class);
        $this->connection = new Connection($this->getCurlMock(true));
        $this->connection->setMerchantConfig(new MerchantConfiguration());
        $this->connection->get('test');
    }

}