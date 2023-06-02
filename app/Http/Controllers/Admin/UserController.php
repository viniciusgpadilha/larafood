<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUpdateuser;

class UserController extends Controller
{
    protected $user;
    
    public function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->paginate();

        return view('admin.pages.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUser $request)
    {
        $tenant = auth()->user()->tenant;
        $data = $request->all();
        $data['tenant_id'] = $tenant->id;

        $this->user->create($data);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->find($id);

        if (!$user) {
            return redirect()->back();
        }

        return view('admin.pages.users.show', [
            'user' => $user
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
        $user = $this->user->find($id);

        if (!$user) {
            return redirect()->back();
        }

        return view('admin.pages.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateUser  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUser $request, $id)
    {
        $user = $this->user->find($id);

        if (!$user) {
            return redirect()->back();
        }

        $user->update($request->all());

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);

        if (!$user) {
            return redirect()->back();
        }

        $user->delete();

        return redirect()->route('users.index');
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $users = $this->user->where(function($query) use ($request) {
                                if($request->filter) {
                                    $query->where('description', 'LIKE', "%{$request->filter}%");
                                    $query->orWhere('name', $request->filter);
                                }
                            })
                            ->paginate();

        return view('admin.pages.users.index', [
            'users' => $users,
            'filters' => $filters,
        ]);
    }
}
