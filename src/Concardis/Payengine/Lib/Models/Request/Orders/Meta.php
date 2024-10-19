<?php

namespace Concardis\Payengine\Lib\Models\Request\Orders;


use Concardis\Payengine\Lib\Internal\AbstractClass\AbstractModel;
use Concardis\Payengine\Lib\Models\Request\Orders\Metas\ThreeDsData;

class Meta extends AbstractModel
{

	/**
	 * @var ThreeDsData
	 */
    private $threeDsData;

    /**
     * @return ThreeDsData
     */
    public function getThreeDsData()
    {
        return $this->threeDsData;
    }

    /**
     * @param ThreeDsData $threeDsData
     */
    public function setThreeDsData($threeDsData)
    {
        $this->threeDsData = $threeDsData;
    }

}