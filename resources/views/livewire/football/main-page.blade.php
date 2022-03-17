<div class="p-2">
    <div class="row mb-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="position-relative overflow-hidden p-md-2 m-md-3 text-center bg-light">
                    <div class="col-md-5 mx-auto my-5">
                        <h1 class="font-weight-normal">Football Matches</h1>
                        <p class="lead font-weight-normal"><small>Created by</small> <strong>Serhii Matsenko</strong>
                        </p>
                    </div>
                    <div class="product-device shadow-sm d-none d-md-block"></div>
                    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            @livewire('football.week-prediction', ['matchId' => $matchId])
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header text-center pb-0">
                    <h6>League Table</h6>
                </div>
                @livewire('football.league-result', ['matchId' => $matchId])
                <div class="card-footer">
                    <button class="btn btn-secondary btn-sm" wire:click="playGames">
                        next week
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            @livewire('football.match-result', ['matchId' => $matchId])
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-8 col-md-8 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header text-center pb-0">
                    <h6>History</h6>
                </div>
                <div class="card-body">
                    Component to show all leagues match histories, all changes store in database
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 mb-md-0 mb-4">
            @livewire('football.match-schedule')
        </div>
    </div>
</div>
