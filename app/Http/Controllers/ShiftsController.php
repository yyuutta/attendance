<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Post;
use App\Inform;
use Carbon\Carbon;
use \Yasumi\Yasumi;

class ShiftsController extends Controller
{
    public function show($id)
    {
        $data = [];
        if (\Auth::user()->authority == 2) {
            $user = User::find($id);
            $posts = $user->posts()->orderBy('date_id', 'asc')->get();
            $now = Carbon::now()->copy();
            $dates = $user->getCalendarDates($now->year,$now->month);
            $go = 0;
            $out = 0;
            $rest = 0;
            $work_time = 0;
            $coment = 0;
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
                'work_time' => $work_time,
                'coment' => $coment,
                'year' => $year,
                'month' => $month,
                'yaer_ago' => $yaer_ago,
                'year_add' => $year_add,
                'comment' => $comment,
                'holidays' => $holidays,
            ];
            
            $data += $this->counts($user);
            return view('shifts.show', $data);
        }else {
            return view('auth.login');
        }
    }
    
    public function create(Request $request)
    {
        if (\Auth::user()->authority == 2) {
            $user = User::find($request->userid);
            $posts = $user->posts()->orderBy('date_id', 'asc')->get();
            $now = Carbon::now()->copy();
            $dates = $user->getCalendarDates($request->year,$request->month);
            $go = 0;
            $out = 0;
            $rest = 0;
            $work_time = 0;
            $coment = 0;
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
                'work_time' => $work_time,
                'coment' => $coment,
                'year' => $year,
                'month' => $month,
                'yaer_ago' => $yaer_ago,
                'year_add' => $year_add,
                'comment' => $comment,
                'holidays' => $holidays,
            ];
            
            $data += $this->counts($user);
            return view('shifts.show', $data);
        }else {
            return view('auth.login');
        }
    }
    
    public function store(Request $request)
    {
        if (\Auth::user()->authority == 2) {
            for($i=0; $i<count($request->date_name); $i++) {
                if($request->coment[$i] == 0) {
                    $coment_up = 'nothing';
                } else {
                    $coment_up = $request->coment[$i];
                }
                Post::updateOrCreate(['user_id' => $request->userid, 'date_id' => $request->date_name[$i]],
                ['user_id' => $request->userid,
                'date_id' => $request->date_name[$i],
                'begin' => $request->go[$i],
                'finish' => $request->out[$i],
                'rest' => $request->rest[$i],
                'work_time' => $request->out[$i] - $request->go[$i] - $request->rest[$i],
                'coment' => $coment_up,
                'absent' => 'nothing',
                'note' => 'nothing']);
            }
            return redirect()->back();
        }else {
            return view('auth.login');
        }
    }
}
