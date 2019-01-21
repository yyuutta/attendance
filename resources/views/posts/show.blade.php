@extends('layouts.app')

@section('content')
<div class="text-header">
    {!! Form::open(['route' => 'posts.create', 'method' => 'get', 'class' => 'form-inline']) !!}
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
    {!! Form::submit('取得', ['class' => 'btn btn-primary btn-xs']) !!}
    {!! Form::close() !!}
</div>
<div class="text-center">
    <div class="main">
    <div class="row">
        <div class="col-xs-12">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>{{$year . "年" . $month . "月"}}</th>
                <th>出勤</th>
                <th>退勤</th>
                <th>休憩</th>
            </th>
            </thead>
            {!! Form::open(['route' => 'posts.store']) !!}
            <tbody>
                @foreach ($dates as $date)
                    @foreach ($posts as $post)
                        @if ($date->formatLocalized('%Y%m%d') == $post->date_id)
                            <?php $go = $post->begin; ?>
                            <?php $out = $post->finish; ?>
                            <?php $rest = $post->rest; ?>
                        @endif
                    @endforeach
                    <tr>
                    @if($date->dayOfWeek == 0 || $date->dayOfWeek == 6)
                        <td><font color="red">{{$date->formatLocalized('%d(%a)')}}</font></td>
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
                        <td>{{$date->formatLocalized('%d(%a)')}}</td>
                        <div class="form-group">
                            <td>
                            {{Form::select('go[]', [
                               '0' => '-',
                               '11' => '11時',
                               '12' => '12時',
                               '13' => '13時',
                               '14' => '14時',
                               '15' => '15時',
                               '16' => '16時',
                               '17' => '17時',
                               '18' => '18時']
                               , $go
                            )}}
                            </td>
                        </div>
                        <div class="form-group">
                            <td>
                            {{Form::select('out[]', [
                               '0' => '-',
                               '11' => '11時',
                               '12' => '12時',
                               '13' => '13時',
                               '14' => '14時',
                               '15' => '15時',
                               '16' => '16時',
                               '17' => '17時',
                               '18' => '18時']
                               , $out
                            )}}
                            </td>
                        </div>
                        <div class="form-group">
                            <td>
                            {{Form::select('rest[]', [
                               '0' => '-',
                               '0.5' => '0.5h',
                               '1' => '1h',]
                               , $rest
                            )}}
                            </td>
                        </div>
                        {{Form::hidden('date_name[]', $date->formatLocalized('%Y%m%d'))}}
                        @endif
                        </tr>
                @endforeach
            </tbody>
            {!! Form::submit('更新', ['class' => 'btn btn-danger btn-block']) !!}
            {!! Form::close() !!}
        </table>
        </div>
    </div>
    </div>
</div>
@endsection