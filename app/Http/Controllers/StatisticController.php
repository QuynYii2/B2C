<?php

namespace App\Http\Controllers;

use App\Enums\StatisticStatus;
use App\Models\StatisticAccess;
use App\Models\StatisticOrderSearch;
use App\Models\StatisticRevenue;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function indexSearch()
    {
        $statistics = StatisticOrderSearch::where('status', StatisticStatus::ACTIVE)->get();
        return $statistics;
    }

    public function indexAccess()
    {
        $statistics = StatisticAccess::where('status', StatisticStatus::ACTIVE)->get();
        return $statistics;
    }

    public function statisticRevenue(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $statistic_revenue = $request->input('statistic_revenue');

        if ($startDate != null && $endDate != null) {
            if ($statistic_revenue == 'low') {
                $statistics = StatisticRevenue::where([
                    ['datetime', '<=', $endDate],
                    ['datetime', '>=', $startDate],
                    ['status', StatisticStatus::ACTIVE]
                ])->orderBy('total_income', 'DESC')->get();
            } else {
                $statistics = StatisticRevenue::where([
                    ['datetime', '<=', $endDate],
                    ['datetime', '>=', $startDate],
                    ['status', StatisticStatus::ACTIVE]
                ])->orderBy('total_income', 'ASC')->get();
            }
        } elseif ($startDate != null && $endDate == null) {
            if ($statistic_revenue == 'low') {
                $statistics = StatisticRevenue::where([
                    ['datetime', '>=', $startDate],
                    ['status', StatisticStatus::ACTIVE]
                ])->orderBy('total_income', 'DESC')->get();
            } else {
                $statistics = StatisticRevenue::where([
                    ['datetime', '>=', $startDate],
                    ['status', StatisticStatus::ACTIVE]
                ])->orderBy('total_income', 'ASC')->get();
            }
        } elseif ($startDate == null && $endDate != null) {
            if ($statistic_revenue == 'low') {
                $statistics = StatisticRevenue::where([
                    ['datetime', '<=', $endDate],
                    ['status', StatisticStatus::ACTIVE]
                ])->orderBy('total_income', 'DESC')->get();
            } else {
                $statistics = StatisticRevenue::where([
                    ['datetime', '<=', $endDate],
                    ['status', StatisticStatus::ACTIVE]
                ])->orderBy('total_income', 'ASC')->get();
            }
        } else {
            if ($statistic_revenue == 'low') {
                $statistics = StatisticRevenue::where('status', StatisticStatus::ACTIVE)
                    ->orderBy('total_income', 'DESC')->get();
            } else {
                $statistics = StatisticRevenue::where('status', StatisticStatus::ACTIVE)
                    ->orderBy('total_income', 'ASC')->get();
            }
        }
        return view('pages/statistic/list-statistic-revenue', compact('statistics'));
    }

    public function statisticSearch(Request $request)
    {
        $service = $request->input('service');
        $statistic_search = $request->input('statistic_search');

        if ($service != 0 && $statistic_search == 0) {
            $statistics = StatisticOrderSearch::where([
                ['service', $service],
                ['status', StatisticStatus::ACTIVE]
            ])->get();
        } elseif ($service == 0 && $statistic_search != 0) {
            if ($statistic_search == 'low') {
                $statistics = StatisticOrderSearch::where(
                    'status', StatisticStatus::ACTIVE
                )->orderBy('statistic_search', 'DESC')->get();
            } else {
                $statistics = StatisticOrderSearch::where(
                    'status', StatisticStatus::ACTIVE
                )->orderBy('statistic_search', 'ASC')->get();
            }
        } elseif ($service != 0 && $statistic_search != 0) {
            if ($statistic_search == 'low') {
                $statistics = StatisticOrderSearch::where([
                    ['service', $service],
                    ['status', StatisticStatus::ACTIVE]
                ])->orderBy('statistic_search', 'DESC')->get();
            } else {
                $statistics = StatisticOrderSearch::where([
                    ['service', $service],
                    ['status', StatisticStatus::ACTIVE]
                ])->orderBy('statistic_search', 'ASC')->get();
            }
        } else {
            $statistics = StatisticOrderSearch::where('status', StatisticStatus::ACTIVE)->orderBy('statistic_search', 'DESC')->get();
        }
        return view('pages/statistic/list-statistic-search', compact('statistics'));
    }

    public function statisticOrder(Request $request)
    {
        $service = $request->input('service');
        $statistic_order = $request->input('statistic_order');

        if ($service != 0 && $statistic_order == 0) {
            $statistics = StatisticOrderSearch::where([
                ['service', $service],
                ['status', StatisticStatus::ACTIVE]
            ])->get();
        } elseif ($service == 0 && $statistic_order != 0) {
            if ($statistic_order == 'low') {
                $statistics = StatisticOrderSearch::where(
                    'status', StatisticStatus::ACTIVE
                )->orderBy('statistic_order', 'DESC')->get();
            } else {
                $statistics = StatisticOrderSearch::where(
                    'status', StatisticStatus::ACTIVE
                )->orderBy('statistic_order', 'ASC')->get();
            }
        } elseif ($service != 0 && $statistic_order != 0) {
            if ($statistic_order == 'low') {
                $statistics = StatisticOrderSearch::where([
                    ['service', $service],
                    ['status', StatisticStatus::ACTIVE]
                ])->orderBy('statistic_order', 'DESC')->get();
            } else {
                $statistics = StatisticOrderSearch::where([
                    ['service', $service],
                    ['status', StatisticStatus::ACTIVE]
                ])->orderBy('statistic_order', 'ASC')->get();
            }
        } else {
            $statistics = StatisticOrderSearch::where('status', StatisticStatus::ACTIVE)->orderBy('statistic_order', 'DESC')->get();
        }
        return view('pages/statistic/list-statistic-order', compact('statistics'));
    }
}
