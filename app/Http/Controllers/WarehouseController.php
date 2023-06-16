<?php

namespace App\Http\Controllers;

use App\Enums\WarehouseStatus;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{
    public function index()
    {
        $isAdmin = $this->checkAdmin();
        if ($isAdmin) {
            $warehouses = Warehouse::where('status', '!=', WarehouseStatus::DELETED)->get();
            return view('pages/warehouse/list', compact('warehouses'));
        }
        return redirect(route('index'));
    }

    // warehouse.index
    public function checkAdmin()
    {
        $user = User::find(Auth::user()->id);
        $roles = $user->roles;
        $isAdmin = false;
        for ($i = 0; $i < count($roles); $i++) {
            if ($roles[$i]->name == \App\Enums\Role::ADMIN) {
                $isAdmin = true;
            }
        }
        return $isAdmin;
    }

    public function detail($id)
    {
        $warehouse = Warehouse::where([['id', $id], ['status', '!=', WarehouseStatus::DELETED]])->first();
        if ($id == null || $warehouse == null) {
            return redirect(route('warehouse.index'));
        }
        $reflector = new \ReflectionClass('App\Enums\WarehouseStatus');
        $listStatus = $reflector->getConstants();

        $isAdmin = $this->checkAdmin();
        if ($isAdmin) {
            return view('pages/warehouse/detail', compact('warehouse', 'listStatus'));
        }
        return redirect(route('index'));
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
        $isAdmin = $this->checkAdmin();
        if ($isAdmin) {
            $reflector = new \ReflectionClass('App\Enums\WarehouseStatus');
            $listStatus = $reflector->getConstants();
            return view('pages/warehouse/create', compact('listStatus'));
        }
        return redirect(route('index'));
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
