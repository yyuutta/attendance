@if (count($user) > 0)
@extends('layouts.app')

@section('content')
<div class="media-body">
@if($user->id != \Auth::user()->id)
    {!! Form::model($user, ['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
    {!! Form::submit('削除', ['class' => 'btn btn-danger btn-block']) !!}
    {!! Form::close() !!}
@endif

<div class="text-center">
    <h2><img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt=""></h2>
    <h2>ID：{{$user->id}} / {{$user->name}}さん</h2>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}
                <div class="form-group">
                @if($user->id != \Auth::user()->id)
                    {{Form::select('authority', [
                    '0' => 'スタッフ',
                    '1' => '管理者']
                    , $user->authority
                    )}}
                @else
                    <p><B>管理者</B></p>
                    {{Form::hidden('authority', 1)}}
                @endif
                </div>
                
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', $user->email, ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit('更新', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
            <p>{!! link_to_route('users.index', '戻る') !!}</p>
        </div>
    </div>
    <br>
    <br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>日付</th>
                <th>出勤</th>
                <th>退勤</th>
                <th>休憩</th>
                <th>勤務時間</th>
                <th>備考</th>
            </th>
        </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>
                {{$post->date_id}}
            </td>
            <td>
                {{$post->begin}}
            </td>
            <td>
                {{$post->finish}}
            </td>
            <td>
                {{$post->rest}}
            </td>
            <td>
                {{$post->work_time}}
            </td>
            <td>
                {{$post->coment}}
            </td>
        </tr>
        @endforeach
        
    </tbody>   
    </table>
    {!! $posts->render() !!}
</div>
</div>
@endsection
@endif