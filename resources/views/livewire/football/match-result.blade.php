<div class="card h-100">
    <div class="card-header pb-0 text-center">
        <h6>{{ $week }} Week Match Results</h6>
    </div>
    <div class="card-body p-3">
        @if($matchResults === null)
            <span class="text-danger">
                            League is not started yet
                        </span>
        @else
            <table class="table text-center rounded table-striped">
                <thead class="bg-dark text-white rounded">
                <tr class="rounded">
                    <th class="rounded-start" style="width: 50%;">First Team</th>
                    <th class="rounded-end" style="width: 50%;">Second Team</th>
                </tr>
                </thead>
                <tbody>
                @foreach($matchResults as $matchResult)
                    <tr class="text-center">
                        <th>{{ $matchResult->schedule->firstTeam->name }}</th>
                        <th>{{ $matchResult->schedule->secondTeam->name }}</th>
                    </tr>
                    <tr class="text-center">
                        <td>{{ $matchResult->first_team_result }}</td>
                        <td>{{ $matchResult->second_team_result }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
