@if (count($users) > 0)
<ul class="media-list">
    <p class="show-button"><b>■マスター</b></p>
    <div class="hide-area">
    @foreach ($users as $user)
        @if($user->authority == 2 && $user->leave == null)
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
    </div>
    
    <br>
    
    <p class="show-button"><b>■管理者</b></p>
    <div class="hide-area">
    @foreach ($users as $user)
        @if($user->authority == 1 && $user->leave == null)
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
    </div>
    
    <br>
    
    <p class="show-button"><b>■スタッフ</b></p>
    <div class="hide-area">
        @foreach ($users as $user)
            @if($user->authority == 0 && $user->leave == null)
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
    </div>
    
    <br>
    
    <p class="show-button"><b>■退社</b></p>
    <div class="hide-area">
        @foreach ($users as $user)
            @if($user->leave != null)
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
    </div>
</ul>
@endif