<?php

namespace Concardis\Payengine\Lib\Models\Request\Orders\Metas;


use Concardis\Payengine\Lib\Internal\AbstractClass\AbstractModel;

class ThreeDsData extends AbstractModel
{

    /**
     * @var string
     */
    private string $threeDsAuthenticationId;

    /**
     * @param string $threeDsAuthenticationId
     */
    public function setThreeDsAuthenticationId($threeDsAuthenticationId): void
    {
        $this->threeDsAuthenticationId = $threeDsAuthenticationId;
    }

    /**
     * @return object
     */
    public function getThreeDsAuthenticationId(): object
    {
        return $this->threeDsAuthenticationId;
    }

}