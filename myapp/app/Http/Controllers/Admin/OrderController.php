<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\customers;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'user', 'service'])->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function create(Request $request)
    {
        $customers = Customers::all();
        $users = User::all();
        $services = Service::where('active', 1)->get();

        $selectedCustomer = $request->input('customer_id') ? Customers::find($request->input('customer_id')) : null;

        return view('admin.orders.create', compact('customers', 'users', 'services', 'selectedCustomer'));
    }





    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
             'service_id' => 'required|exists:services,id|in:' . Service::where('active', 1)->pluck('id')->implode(','),
            'total_price' => 'required|numeric|min:0',
            'order_date' => 'required|date',
            'delivery_date' =>'required|date',
            'status' => 'required|string',
        ]);

        Order::create($request->all());

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function edit(Order $order)
    {
        $customers = customers::all();
        $users = User::all();
        $services = Service::where('active', 1)->get();

        return view('admin.orders.update', compact('order', 'customers', 'users', 'services'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id|in:' . Service::where('active', 1)->pluck('id')->implode(','),
            'total_price' => 'required|numeric|min:0',
            'order_date' => 'required|date',
            'delivery_date' =>'required|date',
            'status' => 'required|string',
        ]);

        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }




    public function softDelete(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order soft deleted successfully.');
    }

    public function restoreView()
{
    $deletedOrders = Order::onlyTrashed()->with(['customer', 'service'])->get();
    return view('admin.orders.restore', compact('deletedOrders'));
}


    public function restore($id)
    {
        $order = Order::onlyTrashed()->findOrFail($id);
        $order->restore();
        return redirect()->route('orders.restore.view')->with('success', 'Order restored successfully.');
    }



    public function forceDelete($id)
    {
        $order = Order::withTrashed()->findOrFail($id);
        $order->forceDelete();

        return redirect()->route('orders.index')->with('success', 'Order permanently deleted.');
    }




}
