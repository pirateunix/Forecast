<body>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">{$city}: <strong>{$current_weather.temperature}&deg;  {$current_weather.cloud}
                , {$current_weather.precipitation},
                Ветер: {$current_weather.wind.direction} {$current_weather.wind.speed}м/с</strong>
        </div>
    </div>
    <h1>{$city}</h1>

    <div class="row">
        <div class="col-md-8">
            <span class="label label-default">Прогноз на 3 дня</span>
            <table class="table">
                <thead>
                <tr>
                    <th>Дата</th>
                    <th>Температура</th>
                    <th>Влажность</th>
                    <th>Давление</th>
                    <th>Облачность</th>
                    <th>Ветер</th>
                    <th>Осадки</th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$weather key=k item=row}
                    <tr>
                        <td>
                            {$row.date->sec|date_format:'d.m.Y'}</td>
                        <td>
                            <strong>{$row.forecast.temperature}&deg;</strong></td>
                        <td>
                            <strong>{$row.forecast.humidity}%</strong></td>
                        <td>
                            <strong>{$row.forecast.pressure}</strong></td>
                        <td>
                            <strong>{$row.forecast.cloud}</strong></td>
                        <td>
                            <strong>{$row.forecast.wind.speed}м/с, {$row.forecast.wind.direction}</strong></td>
                        <td>
                            <strong>{$row.forecast.precipitation}</strong></td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </div>
        <div class="col-md-8">
            <span class="label label-default">Архив погоды</span>
            <table class="table">
                <thead>
                <tr>
                    <th>Дата</th>
                    <th>Температура</th>
                    <th>Влажность</th>
                    <th>Давление</th>
                    <th>Облачность</th>
                    <th>Ветер</th>
                    <th>Осадки</th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$archive key=k item=row}
                    <tr>
                        <td>
                            {$row.date->sec|date_format:'d.m.Y'}</td>
                        <td>
                            <strong>{$row.forecast.temperature}&deg;</strong></td>
                        <td>
                            <strong>{$row.forecast.humidity}%</strong></td>
                        <td>
                            <strong>{$row.forecast.pressure}</strong></td>
                        <td>
                            <strong>{$row.forecast.cloud}</strong></td>
                        <td>
                            <strong>{$row.forecast.wind.speed}м/с, {$row.forecast.wind.direction}</strong></td>
                        <td>
                            <strong>{$row.forecast.precipitation}</strong></td>
                    </tr>
                {/foreach}
                </tbody>
            </table>

        </div>
    </div>
