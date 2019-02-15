<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;
use App\Post;
use App\Inform;
use Carbon\Carbon;
use \Yasumi\Yasumi;

class PostsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $posts = $user->posts()->orderBy('date_id', 'asc')->get();
            
            //退社ユーザーはここではじく
            if ($user->leave != null) {
                return redirect()->intended('/logout');
            } else {
                $now = Carbon::now()->copy();
                $dates = $user->getCalendarDates($now->year,$now->month);
                $go = 0;
                $out = 0;
                $rest = 0;
                $year = $now->year;
                $month = $now->month;
                $yaer_ago = $now->copy()->subYear();
                $year_add = $now->copy()->addYear();
                $comment = Inform::first();
                if(!$comment) {
                    $comment = new Inform;
                    $comment->comment = 'first';
                    $comment->save();
                    $comment = Inform::first();
                }
                
                $holidays = Yasumi::create('Japan', $now->year, 'ja_JP');
                
                $data = [
                    'user' => $user,
                    'posts' => $posts,
                    'dates' => $dates,
                    'now' => $now,
                    'out' => $out,
                    'go' => $go,
                    'rest' => $rest,
                    'year' => $year,
                    'month' => $month,
                    'yaer_ago' => $yaer_ago,
                    'year_add' => $year_add,
                    'comment' => $comment,
                    'holidays' => $holidays,
                ];
                
                $data += $this->counts($user);
                return view('posts.show', $data);
            }
            
        }else {
            return view('auth.login');
        }
    }
 /*    
    public function show($id)
    {
        $user = \Auth::user();
        $posts = $user->posts()->orderBy('date_id', 'asc')->get();
        
    }
*/    
    public function create(Request $request)
    {
        $user = \Auth::user();
        $posts = $user->posts()->orderBy('date_id', 'asc')->get();
        $now = Carbon::now()->copy();
        $dates = $user->getCalendarDates($request->year,$request->month);
        $go = 0;
        $out = 0;
        $rest = 0;
        $year = $request->year;
        $month = $request->month;
        $yaer_ago = $now->copy()->subYear();
        $year_add = $now->copy()->addYear();
        $comment = Inform::first();
        $holidays = Yasumi::create('Japan', $year, 'ja_JP');
        
        $data = [
            'user' => $user,
            'posts' => $posts,
            'dates' => $dates,
            'now' => $now,
            'out' => $out,
            'go' => $go,
            'rest' => $rest,
            'year' => $year,
            'month' => $month,
            'yaer_ago' => $yaer_ago,
            'year_add' => $year_add,
            'comment' => $comment,
            'holidays' => $holidays,
        ];
        
        $data += $this->counts($user);
        return view('posts.show', $data);
    }
    
    public function store(Request $request)
    {
        for($i=0; $i<count($request->date_name); $i++) {
            Post::updateOrCreate(['user_id' => \Auth::id(), 'date_id' => $request->date_name[$i]],
            ['user_id' => \Auth::id(),
            'date_id' => $request->date_name[$i],
            'begin' => $request->go[$i],
            'finish' => $request->out[$i],
            'rest' => $request->rest[$i],
            'work_time' => $request->out[$i] - $request->go[$i] - $request->rest[$i],
            'absent' => 'nothing',
            'coment' => 'nothing',
            'note' => 'nothing']);
        }
        return redirect()->back();
    }
}
