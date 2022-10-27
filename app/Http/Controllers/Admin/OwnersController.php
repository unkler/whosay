<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use App\Models\Owner;
use App\Models\Shop;
use Carbon\Carbon;
use Throwable;

class OwnersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        $owners = Owner::select('id', 'name', 'email', 'created_at')->paginate(3);

        return view('admin.owner.index', compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.owner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:owners'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
           DB::transaction(function () use ($request) {

            $owner = Owner::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Shop::create([
                'owner_id' => $owner->id,
                'name' => '店名を入力してください',
                'information' => '',
                'filename' => '',
                'is_selling' => true,
            ]);

           }, 2);
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return redirect()
            ->route('admin.owners.index')
            ->with([
                'status' => 'info',
                'message' => 'オーナーを登録しました'
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $owner = Owner::findOrFail($id);
    
        return view('admin.owner.edit', compact('owner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('owners')->ignore($id)],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $owner = Owner::findOrFail($id);
        $owner->name = $request->name;
        $owner->email = $request->email;
        $owner->password = Hash::make($request->password);

        $owner->save();

        return redirect()
            ->route('admin.owners.index')
            ->with([
                'status' => 'info',
                'message' => 'オーナーを更新しました'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Owner::findOrFail($id)->delete();

        return redirect()
            ->route('admin.owners.index')
            ->with([
                'status' => 'alert',
                'message' => 'オーナーを削除しました'
            ]);
    }

    public function expiredOwnerIndex()
    {
        $expiredOwners = Owner::onlyTrashed()->get();

        return view('admin.expired-owners', compact('expiredOwners'));
    }

    public function expiredOwnerDestroy($id)
    {
        Owner::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()
            ->route('admin.expired-owners.index')
            ->with([
                'status' => 'alert',
                'message' => 'オーナーを完全に削除しました'
            ]);
    }
}
