@if($go > $out || $go == 0 && $out != 0 || $go == 0 && $out == 0 && $rest != 0)
        <td class="bg-danger"><font color="red">★不整合登録★{{$date->formatLocalized('%d(%a)')}}{{$holidayname}}</font></td>
@else
    @if($go != 0 && $out - $go >= 6.5 && $rest != 1)
        <td class="bg-danger"><font color="red">★休憩1ｈ必須★{{$date->formatLocalized('%d(%a)')}}{{$holidayname}}</font></td>
    @else
        <td>{{$date->formatLocalized('%d(%a)')}}{{$holidayname}}</td>
    @endif
@endif