<?php

namespace App\Http\Controllers;

use App\Models\PostRequest;
use App\Models\User;
use App\Notifications\PostRequestNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class PostRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // mark noti as read
        if ($request->query('noti')) {
            $noti = DatabaseNotification::find($request->query('noti'));

            if ($noti) {
                $noti->markAsRead();
            }
        }

        $user = Auth::user();
        if ($user->isAdmin()) {
            $postRequests = PostRequest::paginate(20);
        } else {
            $postRequests = PostRequest::where('user_id', $user->id)->paginate(20);
        }

        return view('pages.manager.post-requests.list', compact('postRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $postRequest = new PostRequest;
        $postRequest->name = $request->input('name');
        $postRequest->phone = $request->input('phone');
        $postRequest->message = $request->input('message');
        $postRequest->type_id = $request->input('type');
        $postRequest->post_id = $request->input('post');
        $postRequest->user_id = $user ? $user->id : null;

        $postRequest->save();

        // gửi mail đến admin
        $admins = User::where('role', 'admin')->get();
        $data = [
            'fullname' => $postRequest->name,
            'phone' => $postRequest->phone,
            'type' => $postRequest->type_id,
            'action' => strtolower('yêu cầu ' . $postRequest->type->name),
            'title' => '',
            'link' => url('/manager/post-requests'),
            'created_at' => Carbon::now(),
        ];

        foreach ($admins as $admin) {
            $admin->notify(new PostRequestNotification($data));
        }

        return back()->with('alert-modal', 'Yêu cầu của bạn đã được tiếp nhận, chúng tôi sẽ liên lạc với bạn sau');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PostRequest::findOrFail($id)->delete();
        return redirect()->route('post-requests.index')->with('success', 'Xóa yêu cầu thành công');
    }

    public function read(PostRequest $postRequest)
    {
        $postRequest->is_read = true;
        $postRequest->save();

        return redirect()->route('post-requests.index')->with('success', 'Thay đổi trạng thái thành công');
    }

    public function unread(PostRequest $postRequest)
    {
        $postRequest->is_read = false;
        $postRequest->save();

        return redirect()->route('post-requests.index')->with('success', 'Thay đổi trạng thái thành công');
    }
}
