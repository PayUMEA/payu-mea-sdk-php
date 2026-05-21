<?php

namespace PayU\Test\Api;

class Helper
{
    /**
     * Recursively hydrator to convert nested associative arrays to model objects.
     *
     * @param array $data
     * @return array
     */
    public static function hydrateData(array $data): array
    {
        $keyToModelClass = [
            'phone' => \PayUSdk\Model\Phone::class,
            'billingAddress' => \PayUSdk\Model\BillingAddress::class,
            'shippingAddress' => \PayUSdk\Model\ShippingAddress::class,
            'customer' => \PayUSdk\Model\Customer::class,
            'customerInfo' => \PayUSdk\Model\CustomerInfo::class,
            'transaction' => \PayUSdk\Model\Transaction::class,
            'merchant' => \PayUSdk\Model\Merchant::class,
            'redirectUrls' => \PayUSdk\Model\RedirectUrls::class,
            'return' => \PayUSdk\Model\Response::class,
            'fmDetails' => \PayUSdk\Model\FmDetails::class,
            'transactionRecord' => \PayUSdk\Model\TransactionRecord::class,
            'fundingInstrument' => \PayUSdk\Model\FundingInstrument::class,
            'creditCard' => \PayUSdk\Model\CreditCard::class,
            'paymentCard' => \PayUSdk\Model\PaymentCard::class,
            'ebucks' => \PayUSdk\Model\Ebucks::class,
            'eft' => \PayUSdk\Model\EFTBase::class,
            'creditCardToken' => \PayUSdk\Model\CreditCardToken::class,
            'items' => \PayUSdk\Model\Item::class,
            'value' => \PayUSdk\Model\Details::class,
            'entry' => \PayUSdk\Model\LookupDataEntry::class,
            'currency' => \PayUSdk\Model\Currency::class,
            'total' => \PayUSdk\Model\Total::class,
            'redirect' => \PayUSdk\Model\Redirect::class,
            'tax' => \PayUSdk\Model\Tax::class,
            'itemList' => \PayUSdk\Model\ItemList::class,
            'details' => \PayUSdk\Model\Details::class,
            'address' => \PayUSdk\Model\Address::class,
        ];

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                if (isset($keyToModelClass[$key])) {
                    $modelClass = $keyToModelClass[$key];
                    if (count($value) === 0) {
                        $data[$key] = [];
                    } elseif (array_keys($value) !== range(0, count($value) - 1)) {
                        // Associative array -> convert to nested model
                        $data[$key] = new $modelClass(self::hydrateData($value));
                    } else {
                        // List of items
                        $hydratedList = [];
                        foreach ($value as $itemVal) {
                            if (is_array($itemVal)) {
                                $hydratedList[] = new $modelClass(self::hydrateData($itemVal));
                            } else {
                                $hydratedList[] = $itemVal;
                            }
                        }
                        $data[$key] = $hydratedList;
                    }
                } else {
                    $data[$key] = self::hydrateData($value);
                }
            }
        }
        return $data;
    }
}
