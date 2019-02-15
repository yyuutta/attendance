@extends('layouts.app')

@section('content')
<ul class="media-list">
<div class="row">
    <li class="media">
        <div class="col-md-3">
            <div class="media-left">
                @include('users.users', ['users' => $users])
            </div>
        </div>
        <div class="media-body">
        <div class="col-md-12">
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
                      <th class="col-xs-1">{{ $dayOfWeek }}</th>
                  @endforeach
                </tr>
              </thead>
              <tbody>
              @foreach ($dates[$i] as $date)
              
               @foreach($holidays as $holiday)
                    @if($date->formatLocalized('%Y%m%d') == $holiday->format('Ymd'))
                        <?php $holidayname = $holiday->getName(); ?>
                        <?php break; ?>
                    @else
                        <?php $holidayname = null; ?>
                    @endif
                @endforeach
                
                @if ($date->dayOfWeek == 0)
                <tr>
                @endif
                @if ($date->month != $i || $holidayname != null)
                    <td class="p-3 mb-2 bg-success text-white">
                @else
                    <td>
                @endif
                <div class="day_height">
                @if($date->dayOfWeek == 0 || $date->dayOfWeek == 6)
                    <div class="day_height"><font color="lightgrey">{{$date->day}} {{$holidayname}}</font>
                @else
                    @if($holidayname == null)
                        {!! link_to_route('users.monthly', $date->day, ['id' => $date->formatLocalized('%Y/%m/%d')]) !!}
                    @else
                        <font color="lightgrey">{{$date->day}} {{$holidayname}}</font>
                    @endif
                @endif
                </div>
                    </td>
                @if ($date->dayOfWeek == 6)
                </tr>
                @endif
              @endforeach
              </tbody>
            </table>
            @endfor
        </div>
        </div>
        </div>
    </li>
</div>
</ul>
@endsection