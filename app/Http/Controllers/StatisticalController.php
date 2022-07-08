<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class StatisticalController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');

        if (!$start && !$end) {
            $users = User::limit(0);
            return view('pages.manager.statistical.index', compact('users'));
        }

        try {
            if ($start) {
                $startDate = date('Y-m-d H:i:s', strtotime($start));
            } else {
                $startDate = date('Y-m-d H:i:s', strtotime('1970-01-01'));
            }

            if ($end) {
                $endDate = date('Y-m-d H:i:s', strtotime($end));
            } else {
                $endDate = date("Y-m-d H:i:s");
            }
        } catch (Exception $ex) {
            $startDate = date('Y-m-d H:i:s', strtotime('1970-01-01'));
            $endDate = date("Y-m-d H:i:s");
        }

        $users = User::all();
        foreach ($users as $user) {
            $user->posts = Post::whereBetween('created_at', [$startDate, $endDate])->where('user_id', $user->id)->get();
        }

        // if ($start) {
        //     $users->appends(['start' => $start]);
        // }

        // if ($end) {
        //     $users->appends(['end' => $end]);
        // }
        return view('pages.manager.statistical.index', compact('users'));
    }
}
