<?php

namespace Concardis\Payengine\Lib\Models\Request\Orders\Metas;


use Concardis\Payengine\Lib\Internal\AbstractClass\AbstractModel;

class ThreeDsData extends AbstractModel
{

    /**
     * @var object
     */
    private object $threeDsAuthenticationId;

    /**
     * @param object $threeDsAuthenticationId
     */
    public function setThreeDsAuthenticationId(object $threeDsAuthenticationId): void
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