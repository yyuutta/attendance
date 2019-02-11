<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Post;
use App\Inform;
use Carbon\Carbon;
use \Yasumi\Yasumi;

class UsersController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        if ($user->authority == 1) {
            $users = User::all();
            $now = Carbon::now()->copy();
            $year = $now->year;
            $yaer_ago = $now->copy()->subYear();
            $year_add = $now->copy()->addYear();
            for($i=1; $i<=12; $i++) {
                $dates[$i] = $user->getCalendarDates_year($now->year,$i);
            }
            $holidays = Yasumi::create('Japan', $year, 'ja_JP');
            
            return view('users.index', [
                'user' => $user,
                'users' => $users,
                'dates' => $dates,
                'now' => $now,
                'year' => $year,
                'yaer_ago' => $yaer_ago,
                'year_add' => $year_add,
                'holidays' => $holidays,
            ]);
        } else {
            return redirect()->back();
        }
    }
    
   public function create(Request $request)
    {
        $user = \Auth::user();
        if ($user->authority == 1) {
            $users = User::all();
            $now = Carbon::now()->copy();
            $year = $request->year;
            $yaer_ago = $now->copy()->subYear();
            $year_add = $now->copy()->addYear();
            for($i=1; $i<=12; $i++) {
                $dates[$i] = $user->getCalendarDates_year($request->year,$i);
            }
            $holidays = Yasumi::create('Japan', $year, 'ja_JP');
            
            return view('users.index', [
                'user' => $user,
                'users' => $users,
                'dates' => $dates,
                'now' => $now,
                'year' => $year,
                'yaer_ago' => $yaer_ago,
                'year_add' => $year_add,
                'holidays' => $holidays,
            ]);
        } else {
            return redirect()->back();
        }
    }
    
    public function show($id)
    {
        $user = \Auth::user();
        if ($user->authority == 1) {
            $finduser = User::find($id);
            $posts = $finduser->posts()->orderBy('created_at', 'desc')->paginate(15);
            $data = [
                'user' => $finduser,
                'posts' => $posts,
            ];
            return view('users.show', $data);
        } else {
            return redirect()->back();
        }
    }
    
   public function monthly(Request $request)
   {
        $user = \Auth::user();
        if ($user->authority == 1) {
            $users = User::all();
            $posts = Post::where('date_id', $request->id)->get();
            $date_no = $request->id;
            
            $data = [
                'users' => $users,
                'posts' => $posts,
                'date_no' => $date_no,
            ];
            return view('users.monthly', $data);
        } else {
            return redirect()->back();
        }
    }
    
    public function store(Request $request)
    {
        $user = \Auth::user();
        if ($user->authority == 1) {
            $this->validate($request, [
                'coment' => 'required|max:191',
            ]);
            for($i=0; $i<count($request->post_id); $i++) {
                Post::updateOrCreate(['id' => $request->post_id[$i]],
                ['coment' => $request->coment[$i]]);
            }
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
    
    public function update(Request $request, $id)
    {
        $user = \Auth::user();
        if ($user->authority == 1) {
            $finduser = User::find($id);
            $finduser->name = $request->name;
            $finduser->email = $request->email;
            $finduser->authority = $request->authority;
            $finduser->save();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
    
    public function destroy($id)
    {
        $user = \Auth::user();
        if ($user->authority == 1) {
            $finduser = User::find($id);
            $finduser->posts()->delete();
            $finduser->delete();
            return redirect('/users');
        } else {
            return redirect()->back();
        }
    }
}
