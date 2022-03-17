<div class="card">
    <div class="card-header text-center pb-0">
        <h6>Match Schedule</h6>
    </div>
    <div class="card-body p-3">
        <table class="table text-center rounded">
            <tbody>
            @foreach($schedules->groupBy('week') as $weekNumber => $groupedSchedule)
                @foreach($groupedSchedule as $schedule)
                    <tr class="text-center">
                        <td>{{ $schedule->firstTeam->name }}</td>
                        <td>{{ $schedule->secondTeam->name }}</td>
                    </tr>
                @endforeach
                <tr class="text-center">
                    <td colspan="2" class="table-secondary"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">

        </div>
    </div>
</div>
