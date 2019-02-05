
@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <?php $user = Auth::user(); ?>
        エラー　{{ $user->name }}さん、管理者に報告をお願いします。
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the FB-ATTENDANCE</h1>
                {!! link_to_route('signup.get', 'Sign up now!', null, ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection