<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Plan;

class PlanProfileController extends Controller
{
    protected $plan, $profile;

    public function __construct(Profile $profile, Plan $plan) {
        $this->profile = $profile;
        $this->plan = $plan;
    }

    public function profiles($id) {
        $plan = $this->plan->find($id);

        if (!$plan) {
            return redirect()->back();
        }

        $profiles = $plan->profiles()->paginate();

        return view('admin.pages.plans.profiles.profiles', [
            'plan' => $plan,
            'profiles' => $profiles,
        ]);
    }

    public function plans($idProfile) {
        $profile = $this->profile->find($idProfile);

        if (!$profile) {
            return redirect()->back();
        }

        $plans = $profile->plans()->paginate();

        return view('admin.pages.profiles.plans.plan', [
            'plans' => $plans,
            'profile' => $profile,
        ]);
    }

    public function profilesAvailable(Request $request, $id) {
        $plan = $this->plan->find($id);

        if (!$plan) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $profiles = $plan->profilesAvailable($request->filter);

        return view('admin.pages.plans.profiles.available', [
            'plan' => $plan,
            'profiles' => $profiles,
            'filters' => $filters,
        ]);
    }

    public function attachPlansProfile(Request $request, $id) {
        $plan = $this->plan->find($id);

        if (!$plan) {
            return redirect()->back();
        }

        if(!$request->profiles || count($request->profiles) == 0) {
            return redirect()->back()->with('error', 'Precisa escolher ao mesmo uma permissão.');
        }

        $plan->profiles()->attach($request->profiles);

        return redirect()->route('plans.profiles', $plan->id);
    }

    public function detachPlansProfile($id, $idProfile) {
        $plan = $this->plan->find($id);
        $profile = $this->profile->find($idProfile);

        if (!$plan || !$profile) {
            return redirect()->back();
        }

        $plan->profiles()->detach($profile);

        return redirect()->route('plans.profiles', $plan->id);
    }
}
