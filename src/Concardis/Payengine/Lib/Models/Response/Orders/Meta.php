<?php

namespace Concardis\Payengine\Lib\Models\Response\Orders;


use Concardis\Payengine\Lib\Internal\AbstractClass\AbstractResponseModel;
use Concardis\Payengine\Lib\Models\Request\Orders\Payment\CofContract;
use Concardis\Payengine\Lib\Models\Response\Orders\Metas\ThreeDsData;

class Meta extends AbstractResponseModel
{

    /**
     * @var string
     * relevant for RatePAY
     */
    private string $riskIdentId;

    /**
     * @var integer
     * relevant for RatePAY Installment
     */
    private int $totalAmount;

    /**
     * @var integer
     * relevant for RatePAY Installment
     */
    private int $numberOfRates;

    /**
     * @var integer
     * relevant for RatePAY Installment
     */
    private int $rate;

    /**
     * @var integer
     * relevant for RatePAY Installment
     */
    private int $lastRate;

    /**
     * @var float
     * relevant for RatePAY Installment
     */
    private float $interestRate;

    /**
     * @var integer
     * relevant for RatePAY Installment
     */
    private int $paymentFirstDay;

    /**
     * @var string
     * relevant for RatePAY Installment
     */
    private string $descriptor;

    /**
     * @var string
     * relevant for creditcard payments
     */
    private string $threeDs;

    /**
     * @var CofContract
     * relevant for creditcard payments
     */
    private CofContract $cofContract;

    /**
     * @var string
     * relevant for creditcard payments
     */
    private string $flexibleThreeDS;

    /**
     * @var ThreeDsData
     * relevant for creditcard payments
     */
    private ThreeDsData $threeDsData;
    
    /**
     * @return string
     */
    public function getRiskIdentId(): string
    {
        return $this->riskIdentId;
    }

    /**
     * @param string $riskIdentId
     */
    public function setRiskIdentId(string $riskIdentId): void
    {
        $this->riskIdentId = $riskIdentId;
    }

    /**
     * @return int
     */
    public function getTotalAmount(): int
    {
        return $this->totalAmount;
    }

    /**
     * @param int $totalAmount
     */
    public function setTotalAmount(int $totalAmount): void
    {
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return int
     */
    public function getNumberOfRates(): int
    {
        return $this->numberOfRates;
    }

    /**
     * @param int $numberOfRates
     */
    public function setNumberOfRates(int $numberOfRates): void
    {
        $this->numberOfRates = $numberOfRates;
    }

    /**
     * @return int
     */
    public function getRate(): int
    {
        return $this->rate;
    }

    /**
     * @param int $rate
     */
    public function setRate(int $rate): void
    {
        $this->rate = $rate;
    }

    /**
     * @return int
     */
    public function getLastRate(): int
    {
        return $this->lastRate;
    }

    /**
     * @param int $lastRate
     */
    public function setLastRate(int $lastRate): void
    {
        $this->lastRate = $lastRate;
    }

    /**
     * @return float
     */
    public function getInterestRate(): float
    {
        return $this->interestRate;
    }

    /**
     * @param float $interestRate
     */
    public function setInterestRate(float $interestRate): void
    {
        $this->interestRate = $interestRate;
    }

    /**
     * @return int
     */
    public function getPaymentFirstDay(): int
    {
        return $this->paymentFirstDay;
    }

    /**
     * @param int $paymentFirstDay
     */
    public function setPaymentFirstDay(int $paymentFirstDay): void
    {
        $this->paymentFirstDay = $paymentFirstDay;
    }

    /**
     * @return string
     */
    public function getDescriptor(): string
    {
        return $this->descriptor;
    }

    /**
     * @param string $descriptor
     */
    public function setDescriptor(string $descriptor): void
    {
        $this->descriptor = $descriptor;
    }

    
    /**
     * @return string
     */
    public function getThreeDs(): string
    {
        return $this->threeDs;
    }

    /**
     * @param string $threeDs
     */
    public function setThreeDs(string $threeDs): void
    {
        $this->threeDs = $threeDs;
    }

    
    /**
     * @return string
     */
    public function getFlexibleThreeDS(): string
    {
        return $this->flexibleThreeDS;
    }

    /**
     * @param string $flexibleThreeDS
     */
    public function setFlexibleThreeDS(string $flexibleThreeDS): void
    {
        $this->flexibleThreeDS = $flexibleThreeDS;
    }

    /**
     * @return ThreeDsData
     */
    public function getThreeDsData(): ThreeDsData
    {
        return $this->threeDsData;
    }

    /**
     * @param ThreeDsData $threeDsData
     */
    public function setThreeDsData(ThreeDsData $threeDsData): void
    {
        $this->threeDsData = $threeDsData;
    }

        /**
     * @return CofContract
     */
    public function getCofContract(): CofContract
    {
        return $this->cofContract;
    }

    /**
     * @param CofContract $cofContract
     */
    public function setCofContract(CofContract $cofContract): void
    {
        $this->cofContract = $cofContract;
    }

}