<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlanController extends Controller
{
    private $plan;

    public function __construct(Plan $plan) {
        $this->plan = $plan;
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

    public function store(Request $request) {
        $data = $request->all();
        $data['url'] = Str::slug($request->name);
        $this->plan->create($data);

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
        $plan = $this->plan->where('url', $url)->first();

        if (!$plan) {
            return redirect()->back();
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

    public function update(Request $request, $url) {

        $plan = $this->plan->where('url', $url)->first();

        $data = $request->all();
        $data['url'] = Str::slug($request->name);

        $plan->update($data);

        return redirect()->route('plans.index');
    }
}
