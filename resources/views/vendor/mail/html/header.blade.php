@props(['url'])
<tr>
<td class="header" style="text-align: center;">
<a href="{{ $url }}" style="display: inline-block; text-decoration: none;">
{!! $slot !!}
</a>
</td>
</tr>
