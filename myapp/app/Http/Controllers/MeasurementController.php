<?php

namespace App\Http\Controllers;

use App\Models\Measurement;
use App\Models\MeasurementField;
use App\Models\customers;
use App\Models\Service;
use Illuminate\Http\Request;

class MeasurementController extends Controller
{


    public function index()
    {
        $measurements = Measurement::with(['customer', 'service', 'measurementValues'])->get();
        return view('admin.measurement', compact('measurements'));
    }

    public function create()
    {
        $customers = customers::all();
        $services = Service::where('active', 1)->get();

        return view('admin.measurementcreate', compact('customers', 'services'));
    }

    public function getMeasurementFields($service_id)
    {
        $measurementFields = MeasurementField::where('service_id', $service_id)
            ->where('is_required', 1)
            ->orderBy('order')
            ->get();
        return response()->json($measurementFields);
    }



    // public function getMeasurementFields($service_id)
    // {
    //     $measurementFields = MeasurementField::where('service_id', $service_id)->orderBy('order')->get();
    //     return response()->json($measurementFields);
    // }

    public function store(Request $request)
    {

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id|in:' . Service::where('active', 1)->pluck('id')->implode(','),
            'type_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $measurement = Measurement::create($request->only('customer_id', 'service_id', 'type_name', 'description'));

        $measurementFields = $request->input('measurement_fields', []);
             foreach ($measurementFields as $fieldname => $value) {
            $measurementField = MeasurementField::where('fieldname', $fieldname)->first();

            if ($measurementField) {
                $measurement->measurementValues()->create([
                    'measurement_fields_id' => $measurementField->id,
                    'fieldname' => $fieldname,
                    'value' => $value,
                ]);
            }
        }

        return redirect()->route('measurements.index')->with('success', 'Measurement created successfully.');
    }

    public function edit($id)
    {
        $measurement = Measurement::with('measurementValues')->findOrFail($id);
        $customers = customers::all();
        $services = Service::where('active', 1)->get();

        return view('admin.measurementupdate', compact('measurement', 'customers', 'services'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id|in:' . Service::where('active', 1)->pluck('id')->implode(','),
            'type_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $measurement = Measurement::findOrFail($id);
        $measurement->update($request->only('customer_id', 'service_id', 'type_name', 'description'));

        $measurementFields = $request->input('measurement_fields', []);
        foreach ($measurementFields as $fieldname => $value) {
            $measurementField = MeasurementField::where('fieldname', $fieldname)->first();

            if ($measurementField) {
                $measurementValue = $measurement->measurementValues()->where('measurement_fields_id', $measurementField->id)->first();
                if ($measurementValue) {
                    $measurementValue->update(['value' => $value]);
                } else {
                    $measurement->measurementValues()->create([
                        'measurement_fields_id' => $measurementField->id,
                        'fieldname' => $fieldname,
                        'value' => $value,
                    ]);
                }
            }
        }

        return redirect()->route('measurements.index')->with('success', 'Measurement updated successfully.');
    }

    public function destroy($id)
    {
        $measurement = Measurement::findOrFail($id);
        $measurement->measurementValues()->delete();
        $measurement->delete();

        return redirect()->route('measurements.index')->with('success', 'Measurement deleted successfully.');
    }
}
