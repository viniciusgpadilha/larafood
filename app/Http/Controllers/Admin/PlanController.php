<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Http\Requests\StoreUpdatePlan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private $plan;

    public function __construct(Plan $plan) {
        $this->plan = $plan;

        $this->middleware('can:plans');
    }

    public function index() {
        $plans = $this->plan->latest()->paginate(10);

        return view('admin.pages.plans.index', [
            'plans' => $plans,
        ]);
    }

    public function create() {
        return view('admin.pages.plans.create');
    }

    public function store(StoreUpdatePlan $request) {
        $this->plan->create($request->all());

        return redirect()->route('plans.index');
    }

    public function show($url) {
        $plan = $this->plan->where('url', $url)->first();

        if (!$plan) {
            return redirect()->back();
        }

        return view('admin.pages.plans.show', [
            'plan' => $plan,
        ]);
    }

    public function destroy($url) {
        $plan = $this->plan
                        ->with('details')
                        ->where('url', $url)
                        ->first();

        if (!$plan) {
            return redirect()->back();
        }

        if($plan->details->count() > 0) {
            return redirect()
                        ->back()
                        ->with('error', 'Existem detalhes vinculados a este plano');
        }

        $plan->delete();

        return redirect()->route('plans.index');
    }

    public function search(Request $request) {
        $filters = $request->except('_token');

        $plans = $this->plan->search();

        return view('admin.pages.plans.index', [
            'plans' => $plans,
            'filters' => $filters,
        ]);
    }

    public function edit($url) {
        $plan = $this->plan->where('url', $url)->first();

        if (!$plan) {
            return redirect()->back();
        }

        return view('admin.pages.plans.edit', [
            'plan' => $plan,
        ]);
    }

    public function update(StoreUpdatePlan $request, $url) {
        $plan = $this->plan->where('url', $url)->first();

        $plan->update($request->all());

        return redirect()->route('plans.index');
    }
}
