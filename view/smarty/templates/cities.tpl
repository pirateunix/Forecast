<table border="1">
    <tr>
        <th>Список Городов</th>
        {foreach from=$cities key=k item=row}
    <tr>
        <td>
            <li><a href="/WeatherController/addToMy/name-{$row.name}/">{$row.title}</li>
        </td>
        {/foreach}
</table>

