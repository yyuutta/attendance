@extends('layouts.app')

@section('content')
<div class="media-left">
@include('users.users', ['users' => $users])
</div>
<div class="media-body">
<div class="row">
<div class="col-xs-12">
    <h2>{{$date_no}}</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>スタッフ</th>
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
</div>
@endsection     
        