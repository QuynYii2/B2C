<?php

namespace App\Http\Controllers;

use App\Enums\StatisticStatus;
use App\Models\StatisticOrderSearch;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $statistic = StatisticOrderSearch::where('status', StatisticStatus::ACTIVE)->get();
        return view('dashboard');
    }

    public function search_product() {
        return view('pages/search');
    }

}
