@if($user->authority == 1)
    {!! Form::model($comment, ['route' => ['informs.update', $comment->id], 'method' => 'put']) !!}
    <div class="form-group">
        {!! Form::textarea('comment') !!}
        {!! Form::submit('投稿') !!}
    </div>
    {!! Form::close() !!}
    <p>{!! nl2br(e($comment->comment), false) !!}</p>
@else
    <p>{!! nl2br(e($comment->comment), false) !!}</p>
@endif