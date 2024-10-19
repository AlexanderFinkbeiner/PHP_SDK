<?php

namespace Concardis\Payengine\Lib\Test;

require_once __DIR__ . "/../../../../../autoload.php";
include_once "IntegrationTestConfig.php";

use \Concardis\Payengine\Lib\Internal\Config\MerchantConfiguration;
use \Concardis\Payengine\Lib\Models\Request\Customer;
use Concardis\Payengine\Lib\Models\Request\Order;
use Concardis\Payengine\Lib\Models\Request\Orders\ReferencingTransaction;
use Concardis\Payengine\Lib\Models\Response\Orders\Transaction;
use \Concardis\Payengine\Lib\PayEngine;
use \Concardis\Payengine\Lib\Test\Fixture\Model\AuthorizingTransactionFixture;
use \Concardis\Payengine\Lib\Test\Fixture\Model\CustomerFixture;
use Concardis\Payengine\Lib\Test\Fixture\Model\ReferencingTransactionFixture;
use \PHPUnit\Framework\TestCase;

/**
 * @codeCoverageIgnore
 * @group integrationtests
 */
class IntegrationTest extends TestCase
{

    protected  \Concardis\Payengine\Lib\Internal\Config\MerchantConfiguration $merchantConfig;

    private \Concardis\Payengine\Lib\PayEngine $payengine;

    public function setUp(): void {
        $this->merchantConfig = new MerchantConfiguration();
        $this->merchantConfig->setIsLiveMode(
            IntegrationTestConfig::TEST_CONFIG_LIVE_MODE
        );
        $this->merchantConfig->setMerchantId(
            IntegrationTestConfig::TEST_CONFIG_MERCHANT_ID
        );
        $this->merchantConfig->setApiKey(
            IntegrationTestConfig::TEST_CONFIG_API_KEY
        );
        $this->merchantConfig->setEndpoint(
            IntegrationTestConfig::TEST_CONFIG_API_ENDPOINT
        );
        $this->payengine = new Payengine($this->merchantConfig);
    }


    public function testCustomerResource() {
        $uniqueId = uniqid('inttest');
        $customerEmail = $uniqueId . '@testemail.io';
        $merchantCustomerId = "customer_" . $uniqueId;
        $customer = CustomerFixture::getRequest($uniqueId);

        $customerPostResponse = $this->payengine->customer()->post($customer);

        $this->assertNotNull($customerPostResponse);
        $this->assertEquals(
            $customerEmail, $customerPostResponse->getEmail()
        );
        $this->assertEquals(
            $merchantCustomerId, $customerPostResponse->getMerchantCustomerId()
        );

        $customerId = $customerPostResponse->getCustomerId();

        $customerGetResponse = $this->payengine->customer($customerId)->get();

        $this->assertNotNull($customerGetResponse);
        $this->assertEquals(
            $customerEmail, $customerGetResponse->getEmail()
        );
        $this->assertEquals(
            $merchantCustomerId, $customerGetResponse->getMerchantCustomerId()
        );
    }

    public function testCreateAsyncAuthTransactionMinimal() {
        $authorizingTransaction = AuthorizingTransactionFixture::getRequest();
        $authorizingTransactionResponse = $this->payengine->orders()->preauth()->post($authorizingTransaction);
        $this->assertNotNull($authorizingTransactionResponse);
        $this->assertNotEmpty($authorizingTransactionResponse);
    }

    /**
     * 
     * This test refers to github issue #5
     */
    public function testGetTransactions() {
        $authorizingTransaction = AuthorizingTransactionFixture::getRequest();
        $authorizingTransactionResponse = $this->payengine->orders()->preauth()->post($authorizingTransaction);

        $this->assertNotNull($authorizingTransactionResponse);
        $this->assertNotEmpty($authorizingTransactionResponse);

        $orderId = $authorizingTransactionResponse->getOrderId();
        $this->assertNotEmpty($orderId);

        $transactionList = $authorizingTransactionResponse->getTransactions();
        $this->assertNotEmpty($transactionList);
        $transaction = array_pop($transactionList);
        $this->assertNotEmpty($transaction);

        $preauthId = $transaction->getTransactionId();
        $this->assertNotEmpty($preauthId);

        $referencingTransaction = ReferencingTransactionFixture::getRequest();

        //just creating a failing cancel to increase the transaction count
        $this->payengine->orders($orderId)->transactions($preauthId)->cancel()->post($referencingTransaction);

        $referencingTransactionResponse = $this->payengine->orders($orderId)->transactions($preauthId)->cancel()->post($referencingTransaction);

        $this->assertNotNull($referencingTransactionResponse);
        $this->assertNotEmpty($referencingTransactionResponse);
        $this->assertInstanceOf(\Concardis\Payengine\Lib\Models\Response\Order::class, $referencingTransactionResponse->getOrder());

        $orderFromResponse = $referencingTransactionResponse->getOrder();
        $this->assertInstanceOf(\Concardis\Payengine\Lib\Models\Response\Order::class, $orderFromResponse);

        $transactionListFromResponse = $orderFromResponse->getTransactions();
        $this->assertInternalType( 'array', $transactionListFromResponse);

        /* @var $nestedTransaction Transaction */
        $nestedTransaction = $transactionListFromResponse[0];
        $this->assertInstanceOf( Transaction::class, $nestedTransaction);

        $nestedTransactionList = $nestedTransaction->getTransactions();
        $this->assertInternalType( 'array', $nestedTransactionList);
        $this->assertEquals( 2, count($nestedTransactionList));
        $this->assertInternalType( 'string', $nestedTransactionList[0]);
        $this->assertEquals( $referencingTransactionResponse->getTransactionId(), $nestedTransactionList[0]);
        $this->assertInstanceOf( Transaction::class, $nestedTransactionList[1]);



    }
}