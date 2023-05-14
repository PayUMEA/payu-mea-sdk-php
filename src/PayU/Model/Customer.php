<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Model;

use PayU\Api\Data\CustomerDetailInterface;
use PayU\Api\Data\CustomerInterface;
use PayU\Api\Data\FundingInstrumentInterface;
use PayU\Framework\AbstractModel;

/**
 * Class Customer
 *
 * @package PayU\Model
 */
class Customer extends AbstractModel implements CustomerInterface
{
    /**
     * @return ?string
     */
    public function getPaymentMethod(): ?string
    {
        return $this->getData(CustomerInterface::PAYMENT_METHOD);
    }

    /**
     * @return FundingInstrumentInterface
     */
    public function getFundingInstrument(): FundingInstrumentInterface
    {
        return $this->getData(CustomerInterface::FUNDING_INSTRUMENT);
    }

    /**
     * @return CustomerDetailInterface
     */
    public function getCustomerDetail(): CustomerDetailInterface
    {
        return $this->getData(CustomerInterface::CUSTOMER_DETAIL);
    }

    /**
     * @param string $paymentMethod
     * @return $this
     */
    public function setPaymentMethod(string $paymentMethod): static
    {
        return $this->setData(CustomerInterface::PAYMENT_METHOD, $paymentMethod);
    }

    /**
     * @param FundingInstrumentInterface $fundingInstrument
     * @return $this
     */
    public function setFundingInstrument(FundingInstrumentInterface $fundingInstrument): static
    {
        return $this->setData(CustomerInterface::FUNDING_INSTRUMENT, $fundingInstrument);
    }

    /**
     * @param CustomerDetailInterface $customerDetail
     * @return $this
     */
    public function setCustomerDetail(CustomerDetailInterface $customerDetail): static
    {
        return $this->setData(CustomerInterface::CUSTOMER_DETAIL, $customerDetail);
    }
}
