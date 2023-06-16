<?php

namespace App\Http\Controllers;

use App\Enums\WarehouseStatus;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::where('status', '!=', WarehouseStatus::DELETED)->get();
        return view('pages/warehouse/list', compact('warehouses'));
    }

    // warehouse.index

    public function detail($id)
    {
        $warehouse = Warehouse::where([['id', $id], ['status', '!=', WarehouseStatus::DELETED]])->first();
        if ($id == null || $warehouse == null) {
            return redirect(route('warehouse.index'));
        }
        $reflector = new \ReflectionClass('App\Enums\WarehouseStatus');
        $listStatus = $reflector->getConstants();
        return view('pages/warehouse/detail', compact('warehouse', 'listStatus'));
    }

    public function update(Request $request, $id)
    {
        $warehouse = Warehouse::where([['id', $id], ['status', '!=', WarehouseStatus::DELETED]])->first();

        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $status = $request->input('status');

        $warehouse->name = $name;
        $warehouse->email = $email;
        $warehouse->phone = $phone;
        $warehouse->address = $address;
        $warehouse->status = $status;

        $warehouse->save();

        return redirect(route('warehouse.index'));
    }

    public function processCreate()
    {
        $reflector = new \ReflectionClass('App\Enums\WarehouseStatus');
        $listStatus = $reflector->getConstants();
        return view('pages/warehouse/create', compact('listStatus'));
    }

    public function create(Request $request)
    {
        $warehouse = Warehouse::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'status' => $request->input('status'),
        ]);

        return redirect(route('warehouse.index'));
    }
}
