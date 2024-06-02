<?php

namespace Pronko\Authorizenet\Gateway\Request\Builder;

use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;
use Magento\Payment\Gateway\Request\BuilderInterface;
use Magento\Payment\Model\InfoInterface;
use Magento\Sales\Model\Order;
use Magento\Sales\Model\Order\Payment as OrderPayment;

class Totals implements BuilderInterface
{

    /**
     * @inheritDoc
     */
    public function build(array $buildSubject)
    {
        /** @var PaymentDataObjectInterface $paymentDataObject */
        $paymentDataObject = $buildSubject['payment'];

        /** @var InfoInterface|OrderPayment $payment */
        $payment = $paymentDataObject->getPayment();
        $order = $paymentDataObject->getOrder();

        /** @var Order $orderModel */
        $orderModel = $payment->getOrder();

        return [
            'tax' => [
                'amount' => $orderModel->getBaseTaxAmount()
            ],
            'duty' => [
                'amount' => '0'
            ],
            'shipping' => [
                'amount' => $orderModel->getBaseShippingAmount(),
                'name' => $orderModel->getShippingMethod()
            ],
            'poNumber' => $order->getOrderIncrementId()
        ];
    }
}
