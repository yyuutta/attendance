@extends('layouts.app')

@section('content')
<div class="text-header">
    @include('posts.inform', ['dates' => $dates])
 
    {!! Form::open(['route' => 'shifts.create', 'method' => 'get', 'class' => 'form-inline']) !!}
        {{Form::select('year', [
               $yaer_ago->year => $yaer_ago->year . "年",
               $now->year => $now->year . "年",
               $year_add->year => $year_add->year . "年",]
               , $year
        )}}
        {{Form::select('month', [
               '1' => 1 . "月",
               '2' => 2 . "月",
               '3' => 3 . "月",
               '4' => 4 . "月",
               '5' => 5 . "月",
               '6' => 6 . "月",
               '7' => 7 . "月",
               '8' => 8 . "月",
               '9' => 9 . "月",
               '10' => 10 . "月",
               '11' => 11 . "月",
               '12' => 12 . "月",]
               , $month
        )}}
    {{Form::hidden('userid', $user->id)}}
    {!! Form::submit('取得', ['class' => 'btn btn-primary btn-xs']) !!}
    {!! Form::close() !!}
</div>
<div class="text-center">
    <div class="main">
    <h2>ID：{{$user->id}} / {{$user->name}}さんのシフト調整ページ</h2>
    <br>
    <div class="row">
        <div class="col-xs-12">
        {!! Form::open(['route' => 'shifts.store']) !!}
        
            {!! Form::submit('更新', ['class' => 'btn btn-danger btn-lg']) !!}
        
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>{{$year . "年" . $month . "月"}}</th>
                <th>出勤</th>
                <th>退勤</th>
                <th>休憩</th>
                <th>勤務時間</th>
                <th>備考</th>
            </th>
            </thead>
            <tbody>
                @foreach ($dates as $date)
                
                    @foreach($holidays as $holiday)
                        @if($date->formatLocalized('%Y%m%d') == $holiday->format('Ymd'))
                            <?php $holidayname = $holiday->getName(); ?>
                            <?php break; ?>
                        @else
                            <?php $holidayname = null; ?>
                        @endif
                    @endforeach
                
                    @foreach ($posts as $post)
                        @if ($date->formatLocalized('%Y/%m/%d') == $post->date_id)
                            <?php $go = $post->begin; ?>
                            <?php $out = $post->finish; ?>
                            <?php $rest = $post->rest; ?>
                            <?php $work_time = $post->work_time; ?>
                            <?php $coment = $post->coment; ?>
                        @endif
                    @endforeach
                    <tr>
                    @if($date->dayOfWeek == 0 || $date->dayOfWeek == 6 || $holidayname != null)
                        <td><font color="lightgrey">{{$date->formatLocalized('%d(%a)')}}{{$holidayname}}</font></td>
                        <div class="form-group">
                            <td>
                            </td>
                        </div>
                        <div class="form-group">
                            <td>
                            </td>
                        </div>
                        <div class="form-group">
                            <td>
                            </td>
                        </div>
                        <div class="form-group">
                            <td>
                            </td>
                        </div>
                        <div class="form-group">
                            <td>
                            </td>
                        </div>
                    @else
                        @include('posts.check', ['date' => $date, 'holidayname' => $holidayname])
                        @include('posts.posts_true', ['date' => $date])
                        <div class="form-group">
                            <td>
                                {{$work_time}}
                            </td>
                        </div>
                        <div class="form-group">
                            <td>
                                {{$coment}}
                                {{Form::hidden('coment[]', $coment)}}
                            </td>
                        </div>
                    @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{Form::hidden('userid', $user->id)}}
        {!! Form::close() !!}
        </div>
    </div>
    </div>
</div>
@endsection