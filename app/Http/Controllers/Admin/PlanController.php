<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private $plan;

    public function __construct(Plan $plan) {
        $this->plan = $plan;
    }
    public function index() {
        $plans = $this->plan->latest->paginate(10);

        return view('admin.pages.plans.index', [
            'plans' => $plans,
        ]);
    }
}
