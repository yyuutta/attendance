@if($go > $out || $go == 0 && $out != 0 || $go == 0 && $out == 0 && $rest != 0)
    <div class="form-group">
        <td class="bg-danger"><font color="red">★不整合登録★{{$date->formatLocalized('%d(%a)')}}{{$holidayname}}</font></td>
    </div>
@else
    @if($go != 0 && $out - $go >= 6 && $rest != 1)
        <div class="form-group">
            <td class="bg-danger"><font color="red">★休憩1ｈ必須★{{$date->formatLocalized('%d(%a)')}}{{$holidayname}}</font></td>
        </div>
    @else
        <div class="form-group">
            <td>{{$date->formatLocalized('%d(%a)')}}{{$holidayname}}</td>
        </div>
    @endif
@endif