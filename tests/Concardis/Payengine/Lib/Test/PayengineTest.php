<?php

namespace Concardis\Payengine\Lib\Test;

require_once __DIR__ . "/../../../../../autoload.php";

use Concardis\Payengine\Lib\Internal\Config\MerchantConfiguration;
use Concardis\Payengine\Lib\Internal\Connection\Connection;
use Concardis\Payengine\Lib\Internal\Resource\Customers;
use Concardis\Payengine\Lib\Internal\Resource\Orders;
use Concardis\Payengine\Lib\Internal\Resource\PaymentInstruments;
use Concardis\Payengine\Lib\PayEngine;
use PHPUnit\Framework\TestCase;

/**
 * Class PayEngineTest
 * @package Test\Unit\Lib\Payengine
 */
class PayengineTest extends TestCase
{

    public function createInstance_should_succeed(){
        $config = new MerchantConfiguration();
        $payEngine = new PayEngine($config);
        self::assertTrue(is_a($payEngine, PayEngine::class));
    }

    public function setConfig_should_succeed(){
        $config = new MerchantConfiguration();
        $payEngine = new PayEngine($config);
        self::assertTrue(is_a($payEngine, PayEngine::class));
        $payEngine->setConfiguration($config);
    }

    public function setConnection_should_succeed(){
        $config = new MerchantConfiguration();
        $payEngine = new PayEngine($config);
        self::assertTrue(is_a($payEngine, PayEngine::class));
        $payEngine->setConnection(new Connection());
    }

    public function getResourceCustomers_should_succeed(){
        $config = new MerchantConfiguration();
        $payEngine = new PayEngine($config);
        $this->assertTrue(is_a($payEngine->customer(), Customers::class));
    }

    public function getResourceOrders_should_succeed(){
        $config = new MerchantConfiguration();
        $payEngine = new PayEngine($config);
        $this->assertTrue(is_a($payEngine->orders(), Orders::class));
    }
    public function getResourcePaymentInstruments_should_succeed(){
        $config = new MerchantConfiguration();
        $payEngine = new PayEngine($config);
        $this->assertTrue(is_a($payEngine->paymentinstruments(), PaymentInstruments::class));
    }


}
