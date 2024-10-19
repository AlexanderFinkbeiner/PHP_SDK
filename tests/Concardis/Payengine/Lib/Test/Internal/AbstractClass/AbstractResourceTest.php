<?php

namespace Concardis\Payengine\Lib\Test\Internal\AbstractClass;

require_once __DIR__ . "/../../../../../../../autoload.php";

use Concardis\Payengine\Lib\Internal\Config\MerchantConfiguration;
use Concardis\Payengine\Lib\Internal\Connection\Connection;
use Concardis\Payengine\Lib\Internal\Resource\Customers;
use Concardis\Payengine\Lib\PayEngine;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractResourceTest
 * @package Concardis\Payengine\Lib\Test\Internal\AbstractClass
 */
class AbstractResourceTest extends TestCase
{
    /**
     * @var PayEngine
     */
    private $payengine;

    public function setup(): void {
        $this->payengine = new PayEngine(new MerchantConfiguration());
    }

    public function testEmptyFilterArrayTest_should_fail(){
        $this->expectException(\Exception::class);
        $this->payengine->paymentinstruments()->get(array());
    }

    public function testInvalidResourceId_should_fail(){
        $this->expectException(\Exception::class);
        $this->payengine->paymentinstruments(1);
    }

    public function testNumericFilterArrayTest_should_fail(){
        $this->expectException(\Exception::class);
        $this->payengine->paymentinstruments()->get(array('test'));
    }

}
