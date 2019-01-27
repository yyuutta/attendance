@extends('layouts.app')

@section('content')
<ul class="media-list">
    <li class="media">
        <div class="media-left">
        @include('users.users', ['users' => $users])
        </div>
        <div class="media-body">
        <div class="text-header">
          {!! Form::open(['route' => 'users.create', 'method' => 'get', 'class' => 'form-inline']) !!}
              {{Form::select('year', [
                     $yaer_ago->year => $yaer_ago->year . "年",
                     $now->year => $now->year . "年",
                     $year_add->year => $year_add->year . "年",]
                     , $year
              )}}
          {!! Form::submit('取得', ['class' => 'btn btn-primary btn-xs']) !!}
          {!! Form::close() !!}
        </div>
        @for($i=1; $i<=12; $i++)
        <table class="table table-bordered">
          <thead>
            <h3>{{ $i }}月</h3>
            <tr>
              @foreach (['日', '月', '火', '水', '木', '金', '土'] as $dayOfWeek)
              <th>{{ $dayOfWeek }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
          @foreach ($dates[$i] as $date)
            @if ($date->dayOfWeek == 0)
            <tr>
            @endif
            @if ($date->month != $i)
                <td class="p-3 mb-2 bg-success text-white">
            @else
                <td>
            @endif
            @if($date->dayOfWeek == 0 || $date->dayOfWeek == 6)
                <font color="lightgrey">{{$date->day}}</font>
            @else
                {!! link_to_route('users.monthly', $date->day, ['id' => $date->formatLocalized('%Y%m%d')]) !!}
            @endif
                </td>
            @if ($date->dayOfWeek == 6)
            </tr>
            @endif
          @endforeach
          </tbody>
        </table>
        @endfor
        </div>
    </li>
</ul>
@endsection