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