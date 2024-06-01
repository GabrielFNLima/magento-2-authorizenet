<?php

namespace Pronko\Authorizenet\Gateway\Request\Builder;

use Magento\Payment\Gateway\Request\BuilderInterface;

class Charge implements BuilderInterface
{
    /**
     * @inheritDoc
     */
    public function build(array $buildSubject)
    {
        $amount = $buildSubject['amount'];

        return [
            'transactionType'=> 'authCaptureTransaction',
            'amount' => $amount,
        ];
    }
}
