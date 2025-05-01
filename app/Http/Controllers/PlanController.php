<?php

namespace App\Http\Controllers;
use App\Models\Plan;


use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::latest()->get();
        return view('dashboard.plans.index', compact('plans'));
    }
    public function showForUsers()
    {
        $plans = Plan::all();
        return view('home', compact('plans'));
    }
    public function create()
    {
        return view('dashboard.plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'features' => 'required|array',
        ]);

        Plan::create($request->only('name', 'price', 'description', 'features'));

        return redirect()->route('dashboard.plans.index')->with('success', 'تم إضافة الباقة بنجاح.');
    }

    public function edit(Plan $plan)
    {
        return view('dashboard.plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'features' => 'required|array',
        ]);

        $plan->update($request->only('name', 'price', 'description', 'features'));

        return redirect()->route('dashboard.plans.index')->with('success', 'تم تحديث الباقة بنجاح.');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('dashboard.plans.index')->with('success', 'تم حذف الباقة بنجاح.');
    }
}