<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(20);
        $users2 = User::all();
        return view('pages.manager.users.list', compact('users', 'users2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.manager.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->fullname = $request->input('fullname');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('role');
        $user->save();

        return redirect()->route('users.index')->with('success', 'Tạo người dùng thành công');
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
        $user = User::find($id);
        return view('pages.manager.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->fullname = $request->input('fullname');
        $user->role = $request->input('role');

        if ($request->input('password')) {
            if ($request->input('confirm-password') && $request->input('password') === $request->input('confirm-password')) {
                $user->password = Hash::make($request->input('password'));
            } else {
                return back()->with('danger', 'Mật khẩu không trùng khớp');
            }
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Chỉnh sửa người dùng thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            return back()->with('danger', 'Bạn không có quyền xóa người dùng này');
        }

        $currentUser = Auth::user();
        if ($currentUser && $currentUser->isAdmin()) {
            User::findOrFail($user->id)->delete();
            return redirect()->route('users.index')->with('success', 'Xóa người dùng thành công');
        }

        return back()->with('danger', 'Bạn không có quyền thực hiện chức năng này');
    }

    public function editAccount()
    {
        $user = Auth::user();
        return view('pages.manager.users.edit-account', compact('user'));
    }

    public function updateAccount()
    {
        $user = Auth::user();
        $user->fullname = request()->input('fullname');
        if (request()->input('password')) {
            if (request()->input('confirm-password') && request()->input('password') === request()->input('confirm-password')) {
                $user->password = Hash::make(request()->input('password'));
            } else {
                return back()->with('danger', 'Mật khẩu không trùng khớp');
            }
        }

        $user->save();
        return redirect()->route('account.edit')->with('success', 'Cập nhật thành công');
    }
}
