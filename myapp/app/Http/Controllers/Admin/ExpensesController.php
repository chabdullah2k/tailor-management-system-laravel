<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expenses;

class ExpensesController extends Controller
{
    public function index()
    {
        $expenses = Expenses::all();
        return view('admin.expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('admin.expenses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        Expenses::create($validated);

        return redirect()->route('expenses.index')->with('success', 'Expense created successfully.');
    }

    public function edit($id)
    {
        $expense = Expenses::findOrFail($id);
        return view('admin.expenses.update', compact('expense'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $expense = Expenses::findOrFail($id);
        $expense->update($validated);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy($id)
    {
        $expense = Expenses::findOrFail($id);
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense move to trash successfully.');
    }

    public function forceDelete($id)
    {
        $expense = Expenses::withTrashed()->findOrFail($id);
        $expense->forceDelete();

        return redirect()->route('expenses.index')->with('success', 'Expense permanently deleted.');
    }

    public function restoreView()
    {
        $expenses = Expenses::onlyTrashed()->get();
        return view('admin.expenses.restore', compact('expenses'));
    }

    public function restore($id)
    {
        $expense = Expenses::withTrashed()->findOrFail($id);
        $expense->restore();

        return redirect()->route('expenses.index')->with('success', 'Expense restored successfully.');
    }
}
