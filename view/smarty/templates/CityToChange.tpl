<table border="1">
    <tr>
        <th>Список Городов</th>
        {foreach from=$cities key=k item=row}
    <tr>
        <td>
            <li><a href="/WeatherController/change/name-{$row.name}/current-{$current}/">{$row.title}</li>
        </td>
        {/foreach}
</table>

