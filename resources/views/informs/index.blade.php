@extends('layouts.app')

@section('content')
<ul class="media-list">
<div class="row">
    <li class="media">
        <div class="col-md-3">
        <div class="media-left">
            @include('users.users', ['users' => $users])
        </div>
        </div>
        <div class="media-body">
        <div class="col-md-12">
        @foreach ($users as $user)
        <table class="table table-bordered">
            <thead>
                <h3>{!! link_to_route('users.show', $user->id . ":" . $user->name, ['id' => $user->id]) !!}さん</h3>
                <tr>
                    <th>日付</th>
                    <th>出勤</th>
                    <th>退勤</th>
                    <th>休憩</th>
                    <th>勤務時間</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($posts as $post)
                @if($user->id == $post->user_id)
                    @if($post->begin == 0 && $post->finish or $post->rest > 0 || $post->begin > 0 and $post->begin == $post->finish || $post->begin > $post->finish || $post->begin == 0 && $post->finish != 0 || $post->begin == 0 && $post->finish == 0 && $post->rest != 0 || $post->finish - $post->begin - $post->rest <= 0)
                    　　<tr>
                　　	    <td>{{$post->date_id}}★不整合登録★</td>
                            <td>{{$post->begin}}</td>
                            <td>{{$post->finish}}</td>
                            <td>{{$post->rest}}</td>
                            <td>{{$post->work_time}}</td>
                        </tr>
                    </tbody>
                    @else
                        @if($post->begin != 0 && $post->finish - $post->begin >= 6 && $post->rest != 1)
                            <tr>
                        	    <td>{{$post->date_id}}★休憩1ｈ必須★</td>
                                <td>{{$post->begin}}</td>
                                <td>{{$post->finish}}</td>
                                <td>{{$post->rest}}</td>
                                <td>{{$post->work_time}}</td>
                            </tr>
                        @endif
                    @endif
                @endif
            @endforeach
            </tbody>
        </table>
        <br>
        @endforeach
        </div>
        </div>
    </li>
</div>
</ul>
@endsection