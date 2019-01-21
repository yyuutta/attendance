@extends('layouts.app')

@section('content')

ここにカレンダー<br>
パートさんが入力や確認をするページとなります。<br>

    @if ($now->day == 23)
        <?php $user = Auth::user(); ?>
        <p>{{ $user->name }} さん、申し訳ありませんが編集不可です。</p>
    @else
        {{ $now->day }}
    @endif
    {!! link_to_route('users.index', 'Users') !!}
@endsection