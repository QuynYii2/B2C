<?php

namespace App\Http\Controllers;

use App\Libraries\GeoIP;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;

class BaseController extends Controller
{
    public function getLocation(Request $request)
    {
        $geoIp = new GeoIP();
//        dd($request->ip());
        $locale = $geoIp->getCode($request->ip());
        $countries = new Countries();
        $country = $countries->all()->pluck('name.common')->toArray();
        $currencies = $countries->all()->pluck('currencies')->toArray();
        $all = $countries->where('name.common', $locale)->first()->hydrate('currencies')->currencies;
        foreach ($all as $items) {
            $currency = $items->iso->code;
        }
        return $currency;
    }
}
