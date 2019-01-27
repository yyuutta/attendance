<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Post;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $users = User::all();
        $now = Carbon::now()->copy();
        $year = $now->year;
        $yaer_ago = $now->copy()->subYear();
        $year_add = $now->copy()->addYear();
        for($i=1; $i<=12; $i++) {
            $dates[$i] = $user->getCalendarDates_year($now->year,$i);
        }
        return view('users.index', [
            'user' => $user,
            'users' => $users,
            'dates' => $dates,
            'now' => $now,
            'year' => $year,
            'yaer_ago' => $yaer_ago,
            'year_add' => $year_add,
        ]);
    }
    
   public function create(Request $request)
    {
        $user = \Auth::user();
        $users = User::all();
        $now = Carbon::now()->copy();
        $year = $request->year;
        $yaer_ago = $now->copy()->subYear();
        $year_add = $now->copy()->addYear();
        for($i=1; $i<=12; $i++) {
            $dates[$i] = $user->getCalendarDates_year($request->year,$i);
        }
        
        return view('users.index', [
            'user' => $user,
            'users' => $users,
            'dates' => $dates,
            'now' => $now,
            'year' => $year,
            'yaer_ago' => $yaer_ago,
            'year_add' => $year_add,
        ]);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(15);

        $data = [
            'user' => $user,
            'posts' => $posts,
        ];

        $data += $this->counts($user);

        return view('users.show', $data);
    }
    
   public function monthly(Request $request)
   {
        $users = User::all();
        $posts = Post::where('date_id', $request->id)->get();
        
        $data = [
            'users' => $users,
            'posts' => $posts,
        ];
        return view('users.monthly', $data);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'coment' => 'required|max:191',
        ]);
        
        for($i=0; $i<count($request->post_id); $i++) {
            Post::updateOrCreate(['id' => $request->post_id[$i]],
            ['coment' => $request->coment[$i]]);
        }
        return redirect()->back();
    }
    
}
