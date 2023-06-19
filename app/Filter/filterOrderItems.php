<?php
namespace App\Filter;

class filterOrderItems {
    public function filterOrderItems(\Illuminate\Http\Request $request)
    {
        $query = OrderItem::query();

        if ($request->has('warehouses')) {
            $warehouses = $request->input('warehouses');
            $query->whereIn('warehouse_id', $warehouses);
        }

        if ($request->has('username')) {
            $username = $request->input('username');
            $query->whereHas('order.user', function ($subQuery) use ($username) {
                $subQuery->where('username', 'like', '%' . $username . '%');
            });
        }

        if ($request->has('phone')) {
            $phone = $request->input('phone');
            $query->whereHas('order.user', function ($subQuery) use ($phone) {
                $subQuery->where('phone', 'like', '%' . $phone . '%');
            });
        }

        if ($request->has('email')) {
            $email = $request->input('email');
            $query->whereHas('order.user', function ($subQuery) use ($email) {
                $subQuery->where('email', 'like', '%' . $email . '%');
            });
        }

        if ($request->has('status')) {
            $status = $request->input('status');
            $query->where('status', $status);
        }

        $filteredOrderItems = $query->get();

        return $filteredOrderItems;
    }
}
