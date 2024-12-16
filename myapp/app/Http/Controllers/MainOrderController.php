<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customers;
use App\Models\Service;
use App\Models\MeasurementField;
use App\Models\Measurement;
use Illuminate\Http\Request;

class MainOrderController extends Controller
{
    public function mainOrder()
    {
        return view('admin.main_order');
    }

    public function create()
    {
        return view('mainorder.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'measurement_fields.*.field_id' => 'required|exists:measurement_fields,id',
            'measurement_fields.*.value' => 'required',
            'total_price' => 'required|numeric',
            'order_date' => 'required|date',
            'delivery_date' => 'required|date',
            'status' => 'required|in:pending,completed,canceled',
        ]);

        // Create the order
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'service_id' => $request->service_id,
            'total_price' => $request->total_price,
            'order_date' => $request->order_date,
            'delivery_date' => $request->delivery_date,
            'status' => $request->status,
            'user_id' => auth()->id(),
        ]);

        // Create measurements for each field
        foreach ($request->measurement_fields as $measurement) {
            // Create the measurement for the order
            $measurementModel = Measurement::create([
                'customer_id' => $request->customer_id,
                'service_id' => $request->service_id,
                'type_name' => $measurement['field_name'], // Now this is correctly available
                'description' => 'Measurement for ' . $measurement['field_name'], // Customize as needed
            ]);

            // Create measurement values
            $measurementModel->measurementValues()->create([
                'measurement_fields_id' => $measurement['field_id'],
                'fieldname' => $measurement['field_name'],
                'value' => $measurement['value'],
            ]);
        }

        return redirect()->route('mainorder.index')->with('success', 'Order created successfully!');
    }



    public function fetchServices(Request $request)
    {
        $services = Service::all();
        return response()->json($services);
    }

    // Search customers based on phone or name
    public function searchCustomer(Request $request)
    {
        $query = $request->input('phone');
        $customers = Customers::where('name', 'like', "%$query%")
                             ->orWhere('mobile', 'like', "%$query%")
                             ->get();

        return response()->json($customers);
    }

    // Fetch measurement fields for a selected service
    public function fetchMeasurements(Request $request)
    {
        $fields = MeasurementField::where('service_id', $request->service_id)->get();  // Get measurement fields for a service
        return response()->json($fields);
    }

    public function index()
    {
        // Fetch all orders with their related data
        $orders = Order::with(['customer', 'service', 'measurements.measurementField'])->get();

        return view('admin.main_order_index', compact('orders'));
    }
}
