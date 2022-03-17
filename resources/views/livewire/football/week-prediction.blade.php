<div class="card h-100">
    <div class="card-header pb-0 text-center">
        <h6>Week Predictions of Championship</h6>
    </div>
    <div class="card-body p-3">
        @if($teamPredictions === null)
            <span class="text-danger">
                            League is not started yet
                        </span>
        @else
            <table class="table text-center rounded table-striped">
                <thead class="bg-dark text-white rounded">
                <tr class="rounded">
                    <th class="rounded-start" style="width: 50%;">Team</th>
                    <th class="rounded-end" style="width: 50%;">Percent</th>
                </tr>
                </thead>
                <tbody>
                @foreach($teamPredictions as $teamPrediction)
                    <tr class="text-center">
                        <td>{{ $teamPrediction->team->name }}</td>
                        <td>{{ $teamPrediction->percent / 100 }}%</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
