<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MeasurementField;
use App\Models\Service;
use Illuminate\Http\Request;

class MeasurementFieldController extends Controller
{

    public function create()
    {

        $services = Service::where('active', 1)->get();

        return view('admin.measurement_fieldscreate', compact('services'));
    }


    public function index()
    {
        $measurementFields = MeasurementField::all();
        return view('admin.measurement_fields', compact('measurementFields'));
    }



    public function store(Request $request)
{
    $validated = $request->validate([
        'fieldname' => 'required|string|max:255',
        'order' => [
            'required',
            'integer',
            function ($attribute, $value, $fail) use ($request) {
                $exists = MeasurementField::where('order', $value)
                    ->where('service_id', $request->service_id)
                    ->exists();
                if ($exists) {
                    $fail("This order is already taken for the selected service.");
                }
            },
        ],
        'type' => 'required|string',
        'service_id' => 'required|exists:services,id|in:' . Service::where('active', 1)->pluck('id')->implode(','),
        'description' => 'nullable|string',
        'is_required' => 'nullable|boolean',
    ]);

    MeasurementField::create($validated);

    return redirect()->route('measurement_fields.index')->with('success', 'Measurement Field created successfully!');
}

public function update(Request $request, MeasurementField $measurementField)
{
    $validated = $request->validate([
        'fieldname' => 'required|string|max:255|unique:measurement_fields,fieldname,' . $measurementField->id,
        'order' => [
            'required',
            'integer',
            function ($attribute, $value, $fail) use ($request, $measurementField) {
                $exists = MeasurementField::where('order', $value)
                    ->where('service_id', $request->service_id)
                    ->where('id', '!=', $measurementField->id)
                    ->exists();
                if ($exists) {
                    $fail("This order is already taken for the selected service.");
                }
            },
        ],
        'type' => 'required|string',
        'service_id' => 'required|exists:services,id|in:' . Service::where('active', 1)->pluck('id')->implode(','),
        'description' => 'nullable|string',
        'is_required' => 'nullable|boolean',
    ]);

    $measurementField->update($validated);

    return redirect()->route('measurement_fields.index')->with('success', 'Measurement Field updated successfully!');
}


public function edit(MeasurementField $measurementField)
{
    $services = Service::where('active', 1)->get();

    return view('admin.measurement_fieldsupdate', compact('measurementField', 'services'));
}



public function destroy(MeasurementField $measurementField)
{
    if ($measurementField->service_id !== null) {
        return redirect()->route('measurement_fields.index')->with('error', 'Cannot delete this Measurement Field because it is linked to a service.');
    }

    $measurementField->delete();

    return redirect()->route('measurement_fields.index')->with('success', 'Measurement Field deleted successfully.');
}







}
