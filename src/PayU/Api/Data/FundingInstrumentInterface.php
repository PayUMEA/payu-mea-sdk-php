<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Api\Data;

/**
 * Interface FundingInstrumentInterface
 *
 *  Representing a customer's funding instrument.
 *
 * @package PayUSdk\Api\Data
 */
interface FundingInstrumentInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Save card.
     */
    const SAVE_CARD = 'save_card';
    /*
     * Credit card.
     */
    const CREDIT_CARD = 'credit_card';
    /*
     * Electronic Funds Transfer (EFT).
     */
    const EFT = 'eft';
    /*
     * eBucks rewards card.
     */
    const EBUCKS = 'ebucks';
    /*
     * Saved credit card token.
     */
    const CARD_TOKEN = 'card_token';

    /**
     * @return bool Save credit card.
     */
    public function isSaveCard(): bool;

    /**
     * @return ?CreditCardInterface Credit card to pay with.
     */
    public function getCreditCard(): ?CreditCardInterface;

    /**
     * @return ?EftInterface EFT transaction details.
     */
    public function getEft(): ?EftInterface;

    /**
     * @return ?EbucksInterface eBucks rewards card.
     */
    public function getEbucks(): ?EbucksInterface;

    /**
     * @return ?CardTokenInterface Saved card token.
     */
    public function getCardToken(): ?CardTokenInterface;

    /**
     * @param bool $saveCard
     * @return $this
     */
    public function setSaveCard(bool $saveCard): static;

    /**
     * @param CreditCardInterface $creditCard
     * @return $this
     */
    public function setCreditCard(CreditCardInterface $creditCard): static;

    /**
     * @param EftInterface $eft
     * @return $this
     */
    public function setEft(EftInterface $eft): static;

    /**
     * @param EbucksInterface $ebucks
     * @return $this
     */
    public function setEbucks(EbucksInterface $ebucks): static;

    /**
     * @param CardTokenInterface $cardToken
     * @return $this
     */
    public function setCardToken(CardTokenInterface $cardToken): static;
}
