<?php


namespace Modules\Deals\Service;


use Modules\Deals\Entities\Deal;
use Modules\Quotes\Entities\Quote;

class DealService
{


    public function convertToQuote($dealId)
    {

        $deal = Deal::findOrFail($dealId);

        $quote = new Quote();

        $quote->fill($deal->toArray());
        $quote->name = $deal->name;
        $quote->deal()->associate($deal->id);


        if ($deal->owner != null) {
            $quote->changeOwnerTo($deal->owner);
        }

        $quote->save();

        return $quote;

    }

}
