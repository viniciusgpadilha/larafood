<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailsPlan;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateDetailsPlan;

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

    public function store(StoreUpdateDetailsPlan $request, $url) {
        $plan = $this->plan->where('url', $url)->first();

        if (!$plan) {
            return redirect()->back();
        }

        $plan->details()->create($request->all());

        return redirect()->route('details.plan.index', $plan->url);
    }

    public function edit($url, $id) {
        $plan = $this->plan->where('url', $url)->first();
        $details = $this->detailsPlan->find($id);

        if (!$plan || !$details) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.edit', [
            'plan' => $plan,
            'details' => $details,
        ]);
    }

    public function update(StoreUpdateDetailsPlan $request, $url, $id) {
        $plan = $this->plan->where('url', $url)->first();
        $details = $this->detailsPlan->find($id);

        if (!$plan || !$details) {
            return redirect()->back();
        }

        $details->update($request->all());

        return redirect()->route('details.plan.index', $plan->url);
    }

    public function show($url, $id) {
        $plan = $this->plan->where('url', $url)->first();
        $details = $this->detailsPlan->find($id);

        if (!$plan || !$details) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.show', [
            'plan' => $plan,
            'details' => $details,
        ]);
    }

    public function destroy($url, $id) {
        $plan = $this->plan->where('url', $url)->first();
        $details = $this->detailsPlan->find($id);

        if (!$plan || !$details) {
            return redirect()->back();
        }

        $details->delete();

        return redirect()
                    ->route('details.plan.index', $plan->url)
                    ->with('message', 'Registro deletado com sucesso');
    }
}
