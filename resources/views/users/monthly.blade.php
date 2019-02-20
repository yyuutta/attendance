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
            <h2>{{$date_no}}</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>スタッフ</th>
                        <th>エラー</th>
                        <th>出勤</th>
                        <th>退勤</th>
                        <th>休憩</th>
                        <th>勤務時間</th>
                		<th>備考</th>
                    </th>
                </thead>
                {!! Form::open(['route' => 'users.store']) !!}
                <tbody>
                    @foreach ($posts as $post)
                    @if($post->begin != 0)
                        <tr>
                            @foreach ($users as $user)
                                @if($post->user_id == $user->id)
                                    @if($user->id == Auth::user()->id)
                                        <td>*{!! link_to_route('users.show', $user->id . ":" . $user->name, ['id' => $user->id]) !!}</td>
                                    @else
                                        <td>{!! link_to_route('users.show', $user->id . ":" . $user->name, ['id' => $user->id]) !!}</td>
                                    @endif
                                @endif
                            @endforeach
                            <div class="form-group">
                                @if($post->begin == 0 && $post->finish or $post->rest > 0 || $post->finish - $post->begin - $post->rest <= 0 || $post->begin > 0 and $post->begin == $post->finish || $post->begin > $post->finish || $post->begin == 0 && $post->finish != 0 || $post->begin == 0 && $post->finish == 0 && $post->rest != 0)
                                        <td class="bg-danger"><font color="red">★不整合登録★</font></td>
                                @else
                                    @if($post->begin != 0 && $post->finish - $post->begin >= 6 && $post->rest != 1)
                                        <td class="bg-danger"><font color="red">★休憩1ｈ必須★</font></td>
                                    @else
                                        <td>OK</td>
                                    @endif
                                @endif
                                <td>{{$post->begin}}時</td>
                                <td>{{$post->finish}}時</td>
                                <td>{{$post->rest}}h</td>
                                <td>{{$post->work_time}}h</td>
                                <td>
                                {!! Form::textarea('coment[]', $post->coment, ['class' => 'form-control', 'rows' => '1']) !!}
                                {{Form::hidden('post_id[]', $post->id)}}
                                </td>
                            </div>
                        </tr>
                    @endif
                    @endforeach
                </tbody>
                {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </table>
        </div>
        </div>
    </li>
</div>
</ul>
@endsection     
        