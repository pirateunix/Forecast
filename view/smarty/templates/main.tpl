<body>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">{$city}: <strong>{$current_weather.temperature}&deg;  {$current_weather.cloud}
                , {$current_weather.precipitation},
                Ветер: {$current_weather.wind.direction} {$current_weather.wind.speed}м/с</strong>
        </div>
    </div>
    <a href="/WeatherController/listCities/" class="btn btn-primary">Добавить город</a>
    <table class="table">
        <thead>
        <tr>
            <th>№</th>
            <th>Город</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$towns key=k item=row}
            <tr>
                <td>{$k+1}</td>
                <td>
                    <li><a href="/ForecastController/index/name-{$row.name}/">{$row.title}</li>
                </td>
                <td><a href="/WeatherController/listChangeCities/current-{$row.name}/"
                       class="btn btn-warning">Изменить</a>
                    <a href="/WeatherController/dellCity/name-{$row.name}/" class="btn btn-danger">Удалить</a></td>
            </tr>
        {/foreach}
        </tbody>
    </table>
