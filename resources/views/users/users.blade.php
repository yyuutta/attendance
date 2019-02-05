@if (count($users) > 0)
<ul class="media-list">
    <p><b>■管理者</b></p>
    @foreach ($users as $user)
        @if($user->authority == 1)
            <li class="media">
                <div class="media-left">
                    <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
                </div>
                <div class="media-body">
                    <div>
                        @if($user->id == Auth::user()->id)
                            <p>*{!! link_to_route('users.show', $user->id . ":" . $user->name, ['id' => $user->id]) !!}</p>
                        @else
                            <p>{!! link_to_route('users.show', $user->id . ":" . $user->name, ['id' => $user->id]) !!}</p>
                        @endif
                    </div>
                </div>
            </li>
        @endif
    @endforeach
    <br>
    <p><b>■スタッフ</b></p>
    @foreach ($users as $user)
        @if($user->authority == 0)
            <li class="media">
                <div class="media-left">
                    <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
                </div>
                <div class="media-body">
                    <div>
                        <p>{!! link_to_route('users.show', $user->id . ":" . $user->name, ['id' => $user->id]) !!}</p>
                    </div>
                </div>
            </li>
        @endif    
    @endforeach
</ul>
@endif