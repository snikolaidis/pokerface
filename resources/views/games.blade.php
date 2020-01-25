@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Games</div>
                <div class="card-body games">
                    <div class="row title">
                        <div class="col-5 winner-1">
                            Player A
                        </div>
                        <div class="col-5 winner-2">
                            Player B
                        </div>
                        <div class="col-2">
                            Result
                        </div>
                    </div>
                    @foreach ($games as $game)
                        <div class="row with-cards">
                            <div class="col winner-1"><img src="/images/deck/{{ $game->player_a_1 }}.png"></div>
                            <div class="col winner-1"><img src="/images/deck/{{ $game->player_a_2 }}.png"></div>
                            <div class="col winner-1"><img src="/images/deck/{{ $game->player_a_3 }}.png"></div>
                            <div class="col winner-1"><img src="/images/deck/{{ $game->player_a_4 }}.png"></div>
                            <div class="col winner-1"><img src="/images/deck/{{ $game->player_a_5 }}.png"></div>

                            <div class="col winner-2"><img src="/images/deck/{{ $game->player_b_1 }}.png"></div>
                            <div class="col winner-2"><img src="/images/deck/{{ $game->player_b_2 }}.png"></div>
                            <div class="col winner-2"><img src="/images/deck/{{ $game->player_b_3 }}.png"></div>
                            <div class="col winner-2"><img src="/images/deck/{{ $game->player_b_4 }}.png"></div>
                            <div class="col winner-2"><img src="/images/deck/{{ $game->player_b_5 }}.png"></div>
                            
                            <div class="col-2 text-center winner-{{ $game->winner }}">{{ $game->winning_descr }}</div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    <div class="col-10 text-center">
                    {{ $games->links() }}
                    </div>
                    <div class="row btn-block text-right">
                        <a class="btn btn-primary" href="{{ route('results') }}">Back to results</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
