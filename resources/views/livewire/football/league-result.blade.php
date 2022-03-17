<div class="card-body px-3 py-3">
    <table class="table text-center rounded">
        <thead class="bg-dark text-white rounded">
        <tr class="rounded">
            <th class="rounded-start" style="width: 33%;">Team</th>
            <th style="width: 11%;">PTS</th>
            <th style="width: 11%;">P</th>
            <th style="width: 11%;">W</th>
            <th style="width: 11%;">D</th>
            <th style="width: 11%;">L</th>
            <th class="rounded-end" style="width: 11%;">GD</th>
        </tr>
        </thead>
        <tbody>
        @foreach($leagueResults as $leagueResult)
            <tr>
                <th>{{ $leagueResult->team->name }}</th>
                <td>
                    {{ $leagueResult->points }}
                </td>
                <td>
                    {{ $leagueResult->plays }}
                </td>
                <td>
                    {{ $leagueResult->won }}
                </td>
                <td>
                    {{ $leagueResult->drawn }}
                </td>
                <td>
                    {{ $leagueResult->lost }}
                </td>
                <td>
                    {{ $leagueResult->goal_difference }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
