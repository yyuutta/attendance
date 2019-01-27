<div class="form-group">
    @if($go == 0)
    <td>-</td>
    @else
    <td>{{ $go }}時</td>
    @endif
</div>
<div class="form-group">
    @if($out == 0)
    <td>-</td>
    @else
    <td>{{ $out }}時</td>
    @endif
</div>
<div class="form-group">
    @if($rest == 0)
    <td>-</td>
    @else
    <td>{{ $rest }}h</td>
    @endif
</div>