<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\customers;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $customers = customers::all();
        $users = User::all();
        return view('admin.reports.index', compact('customers', 'users'));
    }

    public function create()
    {
        $customers = customers::all();
        $users = User::all();
        return view('admin.reports.showreport', compact('customers', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reports_id' => 'required|in:1,2,3',
            'user_id' => 'required_if:reports_id,1|exists:users,id',
            'customer_id' => 'required_if:reports_id,2|exists:customers,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $reportType = $request->reports_id;
        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();
        $data = null;
        $type = null;

        if ($reportType == 1) {
            $data = User::where('id', $request->user_id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->first();
            $type = 'User Report';
        } elseif ($reportType == 2) {
            $data = customers::withCount(['orders' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }])
            ->withSum(['orders' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }], 'total_price')
            ->find($request->customer_id);
            $type = 'Customer Report';
        } else {
            $data = 'This is a General Report.';
            $type = 'General Report';
        }

        return view('admin.reports.showreport', compact('data', 'type'));
    }
}
