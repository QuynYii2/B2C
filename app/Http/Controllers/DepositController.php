<?php

namespace App\Http\Controllers;

use App\Enums\DepositStatus;
use App\Models\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::where('status', '!=', DepositStatus::DELETED)->get();
        return view('pages/deposit/list', compact('deposits'));
    }

    public function indexApi()
    {
        return Deposit::where('status', '!=', DepositStatus::DELETED)->get();
    }

    public function create()
    {
        return view('pages/deposit/create');
    }

    public function store(Request $request)
    {
        try {
            Deposit::create([
                'address_from' => $request->input('address_from'),
                'address_to' => $request->input('address_to'),
                'distance' => $request->input('distance'),
                'price_percent' => $request->input('price_percent'),
                'shipping_fee' => $request->input('shipping_fee'),
                'tax_percent' => $request->input('tax_percent'),
                'weight' => $request->input('weight'),
                'description' => $request->input('description'),
                'status' => $request->input('status')
            ]);

            return redirect(route('deposit.index'))->with('message', 'success');
        } catch (\Exception $exception) {
            return back()->with('error', 'error');
        }

    }

    public function detail($id)
    {
        $deposit = Deposit::find($id);
        return view('pages/deposit/detail', compact('deposit'));
    }

    public function update(Request $request, $id)
    {
        try {
            $deposit = Deposit::find($id);
            // find request
            $address_from = $request->input('address_from');
            $address_to = $request->input('address_to');
            $distance = $request->input('distance');
            $price_percent = $request->input('price_percent');
            $shipping_fee = $request->input('shipping_fee');
            $tax_percent = $request->input('tax_percent');
            $weight = $request->input('weight');
            $description = $request->input('description');
            $status = $request->input('status');
            // update deposit
            $deposit->address_from = $address_from;
            $deposit->address_to = $address_to;
            $deposit->distance = $distance;
            $deposit->price_percent = $price_percent;
            $deposit->shipping_fee = $shipping_fee;
            $deposit->tax_percent = $tax_percent;
            $deposit->weight = $weight;
            $deposit->description = $description;
            $deposit->status = $status;
            $deposit->save();

            return redirect(route('deposit.index'))->with('message', 'success');
        } catch (\Exception $exception) {
            return back()->with('error', 'error');
        }
    }

    public function destroy($id)
    {
        try {
            $deposit = Deposit::find($id);
            $deposit->status = DepositStatus::DELETED;
            $deposit->save();

            return redirect(route('deposit.index'))->with('message', 'success');
        } catch (\Exception $exception) {
            return back()->with('error', 'error');
        }
    }
}
