@extends('layouts.app')

@section('content')
<div class="media-body">
{{--
@if($user->id != \Auth::user()->id)
    {!! Form::model($user, ['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
    {!! Form::submit('削除', ['class' => 'btn btn-danger btn-block']) !!}
    {!! Form::close() !!}
@endif
--}}
<div class="text-center">
    <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
    <h2>ID：{{$user->id}} / {{$user->name}}さん</h2>
    <h4>{!! link_to_route('shifts.show', 'シフトページ', ['id' => $user->id]) !!}</h4>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}
                <div class="form-group">
                @if($user->id != \Auth::user()->id)
                    {{Form::select('authority', [
                    '0' => 'スタッフ',
                    '1' => '管理者',
                    '2' => 'マスター']
                    , $user->authority
                    )}}
                @else
                    @if($user->authority == 2)
                        <p><B>マスター</B></p>
                        {{Form::hidden('authority', 2)}}
                    @else
                        <p><B>管理者</B></p>
                        {{Form::hidden('authority', 1)}}
                    @endif
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
                
                @if($user->id != \Auth::user()->id)
                <div class="form-group">
                    {!! Form::label('leave', 'Leave  例：2019年2月1日に退社→2019/02/01') !!}
                    {!! Form::text('leave', $user->leave, ['class' => 'form-control']) !!}
                </div>
                @endif
                
                {!! Form::submit('更新', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
            <br>
            <p>{!! link_to_route('users.index', '戻る') !!}</p>
        </div>
    </div>
</div>
</div>
@endsection