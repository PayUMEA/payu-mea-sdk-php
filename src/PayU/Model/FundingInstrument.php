<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Model;

use PayU\Api\Data\CardTokenInterface;
use PayU\Api\Data\CreditCardInterface;
use PayU\Api\Data\EbucksInterface;
use PayU\Api\Data\EftInterface;
use PayU\Api\Data\FundingInstrumentInterface;
use PayU\Framework\AbstractModel;

/**
 * Class FundingInstrument
 *
 * @package PayU\Api
 */
class FundingInstrument extends AbstractModel implements FundingInstrumentInterface
{
    /**
     * @return bool
     */
    public function isSaveCard(): bool
    {
        return $this->getData(FundingInstrumentInterface::SAVE_CARD);
    }

    /**
     * @return ?CreditCardInterface
     */
    public function getCreditCard(): ?CreditCardInterface
    {
        return $this->getData(FundingInstrumentInterface::CREDIT_CARD);
    }

    /**
     * @return ?EftInterface
     */
    public function getEft(): ?EftInterface
    {
        return $this->getData(FundingInstrumentInterface::EFT);
    }

    /**
     * @return ?EbucksInterface
     */
    public function getEbucks(): ?EbucksInterface
    {
        return $this->getData(FundingInstrumentInterface::EBUCKS);
    }

    /**
     * @return ?CardTokenInterface
     */
    public function getCardToken(): ?CardTokenInterface
    {
        return $this->getData(FundingInstrumentInterface::CARD_TOKEN);
    }

    /**
     * @param bool $saveCard
     * @return $this
     */
    public function setSaveCard(bool $saveCard): static
    {
        return $this->setData(FundingInstrumentInterface::SAVE_CARD, $saveCard);
    }

    /**
     * @param CreditCardInterface $creditCard
     * @return $this
     */
    public function setCreditCard(CreditCardInterface $creditCard): static
    {
        return $this->setData(FundingInstrumentInterface::CREDIT_CARD, $creditCard);
    }

    /**
     * @param EftInterface $eft
     * @return $this
     */
    public function setEft(EftInterface $eft): static
    {
        return $this->setData(FundingInstrumentInterface::EFT, $eft);
    }

    /**
     * @param EbucksInterface $ebucks
     * @return $this
     */
    public function setEbucks(EbucksInterface $ebucks): static
    {
        return $this->setData(FundingInstrumentInterface::EBUCKS, $ebucks);
    }

    /**
     * @param CardTokenInterface $cardToken
     * @return $this
     */
    public function setCardToken(CardTokenInterface $cardToken): static
    {
        return $this->setData(FundingInstrumentInterface::CARD_TOKEN, $cardToken);
    }
}
