<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Post;
use App\Inform;
use Carbon\Carbon;
use \Yasumi\Yasumi;

class InformsController extends Controller
{
    public function update(Request $request, $id)
    {
        $user = \Auth::user();
        if ($user->authority == 1) {
            $inform = Inform::find($id);
            $inform->comment = $request->comment;
            $inform->save();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
