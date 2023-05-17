<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Http\Requests\StoreUpdateProfile;

class ProfileController extends Controller
{
    public function __construct(Profile $profile) {
        $this->profile = $profile;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = $this->profile->paginate();

        return view('admin.pages.profiles.index', [
            'profiles' => $profiles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateProfile  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProfile $request)
    {
        $this->profile->create($request->all());

        return redirect()->route('profiles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = $this->profile->find($id);

        if (!$profile) {
            return redirect()->back();
        }

        return view('admin.pages.profiles.show', [
            'profile' => $profile
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = $this->profile->find($id);

        if (!$profile) {
            return redirect()->back();
        }

        return view('admin.pages.profiles.edit', [
            'profile' => $profile,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateProfile  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProfile $request, $id)
    {
        $profile = $this->profile->find($id);

        if (!$profile) {
            return redirect()->back();
        }

        $profile->update($request->all());

        return redirect()->route('profiles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = $this->profile->find($id);

        if (!$profile) {
            return redirect()->back();
        }

        $profile->delete();

        return redirect()->route('profiles.index');
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $profiles = $this->profile
                            ->where(function($query) use ($request) {
                                if($request->filter) {
                                    $query->where('name', $request->filter)
                                        ->orWhere('description', 'LIKE', "%{$request->filter}%");
                                }
                            })
                            ->paginate();

        return view('admin.pages.profiles.index', [
            'profiles' => $profiles,
            'filters' => $filters,
        ]);
    }
}
