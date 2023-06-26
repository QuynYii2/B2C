<?php

namespace App\Http\Controllers;

use App\Enums\StatisticStatus;
use App\Libraries\GeoIP;
use App\Models\StatisticOrderSearch;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $this->getLocale($request);
        $statistic = StatisticOrderSearch::where('status', StatisticStatus::ACTIVE)->get();
        return view('dashboard');
    }

    public function search_product(Request $request)
    {
        $this->getLocale($request);
        return view('pages/search');
    }

    public function getLocale(Request $request)
    {
        $locale = '';
        if ($request->session()->has('locale')) {
            $locale = $request->session()->get('locale');
            app()->setLocale($request->session()->get('locale'));
        } else {
            $ipAddress = $request->ip();
            $geoIp = new GeoIP();
            $locale = $geoIp->get_country_from_ip('183.80.130.4');
            if ($locale !== null && is_array($locale)) {
                $locale = $locale['countryCode'];
            } else {
                $locale = 'vi';
            }
        }
        app()->setLocale($locale);
    }

}
