@extends('layouts.app')

@section('content')
<div class="media-left">
@include('users.users', ['users' => $users])
</div>
<div class="media-body">
<div class="row">
<div class="col-xs-12">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>スタッフ</th>
                <th>出勤</th>
                <th>退勤</th>
                <th>休憩</th>
        		<th>備考</th>
        		<th>当欠</th>
            </th>
        </thead>
        {!! Form::open(['route' => 'users.store']) !!}
        <tbody>
            @foreach ($posts as $post)
            <tr>
                @foreach ($users as $user)
                    @if($post->user_id == $user->id)
                        <td>{{$user->name}}</td>
                    @endif
                @endforeach
                <div class="form-group">
                    <td>{{$post->begin}}時</td>
                    <td>{{$post->finish}}時</td>
                    <td>{{$post->rest}}h</td>
                    <td>
                    {!! Form::textarea('coment[]', $post->coment, ['class' => 'form-control', 'rows' => '1']) !!}
                    {{Form::hidden('post_id[]', $post->id)}}
                    </td>
                    <td></td>
                </div>
            </tr>
            @endforeach
        </tbody>
        {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
        {!! Form::close() !!}
    </table>
</div>
</div>
</div>
@endsection     
        