<?php
namespace App\Http\Controllers\Admin;

use App\Models\customers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customers::all();
        return view('admin.customers.customers', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.customerscreate');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email',
        'mobile' => 'nullable|string|max:15|unique:customers,mobile',  // Ensure mobile is unique
        'opening_balance' => 'nullable|numeric',
        'description' => 'nullable|string',
        'address' => 'nullable|string',
    ]);

    Customers::create([
        'name' => $request->name,
        'mobile' => $request->mobile,
        'email' => $request->email,
        'opening_balance' => $request->opening_balance,
        'description' => $request->description,
        'address' => $request->address,
    ]);

    return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
}


    public function edit($id)
    {
        $customer = Customers::findOrFail($id);
        return view('admin.customers.customersupdate', compact('customer'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email' ,
        'mobile' => 'nullable|string|max:15|unique:customers,mobile,' . $id,
        'opening_balance' => 'nullable|numeric',
        'description' => 'nullable|string',
        'address' => 'nullable|string',
    ]);

    $customer = Customers::findOrFail($id);
    $customer->update([
        'name' => $request->name,
        'mobile' => $request->mobile,
        'email' => $request->email,
        'opening_balance' => $request->opening_balance,
        'description' => $request->description,
        'address' => $request->address,
    ]);

    return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
}




    public function destroy($id)
    {
        $customer = Customers::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Expense move to trash successfully.');
    }

    public function forceDelete($id)
    {
        $customer = Customers::withTrashed()->findOrFail($id);
        $customer->forceDelete();

        return redirect()->route('customers.index')->with('success', 'Expense permanently deleted.');
    }

    public function restoreView()
    {
        $customers = Customers::onlyTrashed()->get();
        return view('admin.customers.restore', compact('customers'));
    }

    public function restore($id)
    {
        $customer = Customers::withTrashed()->findOrFail($id);
        $customer->restore();

        return redirect()->route('customers.index')->with('success', 'Expense restored successfully.');
    }

// laravel serching
    // public function search(Request $request)
    // {
    //     $query = $request->input('search');

    //     $customers = Customers::where('mobile', 'like', "%{$query}%")
        // ->orWhere('name', 'like', "%{$query}%")

    // ->get();

    //     return view('admin.customers.customers', compact('customers'))
    //         ->with('success', 'Search results for: ' . $query);
    // }

    // serching with js
    public function search(Request $request)
    {
        $query = $request->input('search');

        $customers = Customers::with(['orders:id,customer_id'])
            ->where('mobile', 'like', "%{$query}%")
            ->orWhere('name', 'like', "%{$query}%")
            ->select('id', 'name', 'mobile')
            ->limit(10)
            ->get();

        $customers->each(function ($customer) {
            $customer->orders = $customer->orders->toArray();
        });

        return response()->json($customers);
    }





    public function show($id)
    {
        $customer = Customers::with(['orders' => function ($query) {
            $query->withTrashed();
        }])->findOrFail($id);

        $orders = $customer->orders;

        if ($orders->isEmpty()) {
            return redirect()->route('orders.create', ['customer_id' => $customer->id]);
        }

        return view('admin.customers.details', compact('customer', 'orders'));
    }






// public function show($id)
// {
//     $customer = Customers::findOrFail($id);
//     return view('admin.customers.details', compact('customer'));
// }
}
