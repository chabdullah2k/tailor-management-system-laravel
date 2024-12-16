<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.services.services', compact('services'));
    }

    public function create()
    {
        return view('admin.services.servicescreate');
    }

    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required',
            'code' => 'required|unique:services,code',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['active'] = $request->has('active');

        Service::create($data);

        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.servicesupdate', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:services,code,' . $service->id,
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['active'] = $request->has('active');

        $service->update($data);

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }


    public function destroy($id)
{
    $service = Service::findOrFail($id);

    if ($service->measurements()->exists()) {
        return redirect()->route('services.index')->with('error', 'Cannot delete this service because it has associated measurements.');
    }
    $service->delete();
    return redirect()->route('services.index')->with('success', 'Service moved to trash successfully.');
}


public function restoreView()
{
    $services = Service::onlyTrashed()->get();

    return view('admin.services.restore', compact('services'));
}



public function forceDelete($id)
{
    $service = Service::withTrashed()->findOrFail($id);

    if ($service->measurements()->exists()) {
        return redirect()->route('services.index')->with('error', 'Cannot delete this service because it has associated measurements.');
    }

    $service->forceDelete();

    return redirect()->route('services.index')->with('success', 'Service permanently deleted.');
}



public function restore($id)
    {
        $service = Service::withTrashed()->findOrFail($id);
        $service->restore();

        return redirect()->route('services.index')->with('success', 'services restored successfully.');
    }

}
