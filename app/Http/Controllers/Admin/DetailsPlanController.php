<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailsPlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class DetailsPlanController extends Controller
{
    protected $detailsPlan, $plan;

    public function __construct(DetailsPlan $detailsPlan, Plan $plan) {
        $this->detailsPlan  = $detailsPlan;
        $this->plan         = $plan;
    }

    public function index($url) {
        $plan = $this->plan->where('url', $url)->first();

        if (!$plan) {
            return redirect()->back();
        }

        $details = $plan->details;

        return view('admin.pages.plans.details.index', [
            'plan'      => $plan,
            'details'   => $details,
        ]);
    }

    public function create($url) {
        $plan = $this->plan->where('url', $url)->first();

        if (!$plan) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.create', [
            'plan' => $plan,
        ]);
    }

    public function store(Request $request, $url) {
        $plan = $this->plan->where('url', $url)->first();

        if (!$plan) {
            return redirect()->back();
        }

        $plan->details()->create($request->all());

        return redirect()->route('details.plan.index', $plan->url);
    }
}
