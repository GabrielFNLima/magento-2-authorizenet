<?php

namespace Pronko\Authorizenet\Gateway\Request;

use Magento\Payment\Gateway\Request\BuilderInterface;

class RequestBuilder implements BuilderInterface
{
    /**
     * @var BuilderInterface
     */
    private BuilderInterface $builderComposite;

    /**
     * @param BuilderInterface $builderComposite
     */
    public function __construct(BuilderInterface $builderComposite)
    {
        $this->builderComposite = $builderComposite;
    }

    /**
     * @inheritDoc
     */
    public function build(array $buildSubject)
    {
        return [
          'createTransactionRequest' => [
              'merchantAuthentication'=>[
                  'name'=>'',
                  'transactionKey'=>''
              ],
              'transactionRequest' => $this->builderComposite->build($buildSubject)
          ]
        ];
    }
}
