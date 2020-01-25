@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Results</div>
                <div class="card-body results">
                    <div class="row title">
                        <div class="col-6 mb-3">Player A</div>
                        <div class="col-6 mb-3 text-right">Player B</div>
                    </div>
                    <div class="row">
                        <div class="col score {{ $stats["player_A"]["wins"] > $stats["player_B"]["wins"] ? 'winner' : '' }}">{{ $stats["player_A"]["wins"] }}</div>
                        <div class="col-6">
                            @if ($stats["player_A"]["wins"] + $stats["player_B"]["wins"] > 0)
                            <a href="/games">
                                <img src="/images/wins.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            </a>
                            @else
                                <img src="/images/wins.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            @endif
                        </div>
                        <div class="col score {{ $stats["player_A"]["wins"] < $stats["player_B"]["wins"] ? 'winner' : '' }}">{{ $stats["player_B"]["wins"] }}</div>
                    </div>
                    <div class="row">
                        <div class="col score {{ $stats["player_A"]["royal_flush"] > $stats["player_B"]["royal_flush"] ? 'winner' : '' }}">{{ $stats["player_A"]["royal_flush"] }}</div>
                        <div class="col-6">
                            @if ($stats["player_A"]["royal_flush"] + $stats["player_B"]["royal_flush"] > 0)
                            <a href="/games/100">
                                <img src="/images/royal_flush.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            </a>
                            @else
                                <img src="/images/royal_flush.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            @endif
                        </div>
                        <div class="col score {{ $stats["player_A"]["royal_flush"] < $stats["player_B"]["royal_flush"] ? 'winner' : '' }}">{{ $stats["player_B"]["royal_flush"] }}</div>
                    </div>
                    <div class="row">
                        <div class="col score {{ $stats["player_A"]["straight_flush"] > $stats["player_B"]["straight_flush"] ? 'winner' : '' }}">{{ $stats["player_A"]["straight_flush"] }}</div>
                        <div class="col-6">
                            @if ($stats["player_A"]["straight_flush"] + $stats["player_B"]["straight_flush"] > 0)
                            <a href="/games/90">
                                <img src="/images/straight_flush.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            </a>
                            @else
                                <img src="/images/straight_flush.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            @endif
                        </div>
                        <div class="col score {{ $stats["player_A"]["straight_flush"] < $stats["player_B"]["straight_flush"] ? 'winner' : '' }}">{{ $stats["player_B"]["straight_flush"] }}</div>
                    </div>
                    <div class="row">
                        <div class="col score {{ $stats["player_A"]["four_of_a_kind"] > $stats["player_B"]["four_of_a_kind"] ? 'winner' : '' }}">{{ $stats["player_A"]["four_of_a_kind"] }}</div>
                        <div class="col-6">
                            @if ($stats["player_A"]["four_of_a_kind"] + $stats["player_B"]["four_of_a_kind"] > 0)
                            <a href="/games/80">
                                <img src="/images/four_of_a_kind.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            </a>
                            @else
                                <img src="/images/four_of_a_kind.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            @endif
                        </div>
                        <div class="col score {{ $stats["player_A"]["four_of_a_kind"] < $stats["player_B"]["four_of_a_kind"] ? 'winner' : '' }}">{{ $stats["player_B"]["four_of_a_kind"] }}</div>
                    </div>
                    <div class="row">
                        <div class="col score {{ $stats["player_A"]["full_house"] > $stats["player_B"]["full_house"] ? 'winner' : '' }}">{{ $stats["player_A"]["full_house"] }}</div>
                        <div class="col-6">
                            @if ($stats["player_A"]["full_house"] + $stats["player_B"]["full_house"] > 0)
                            <a href="/games/70">
                                <img src="/images/full_house.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            </a>
                            @else
                                <img src="/images/full_house.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            @endif
                        </div>
                        <div class="col score {{ $stats["player_A"]["full_house"] < $stats["player_B"]["full_house"] ? 'winner' : '' }}">{{ $stats["player_B"]["full_house"] }}</div>
                    </div>
                    <div class="row">
                        <div class="col score {{ $stats["player_A"]["flush"] > $stats["player_B"]["flush"] ? 'winner' : '' }}">{{ $stats["player_A"]["flush"] }}</div>
                        <div class="col-6">
                            @if ($stats["player_A"]["flush"] + $stats["player_B"]["flush"] > 0)
                            <a href="/games/60">
                                <img src="/images/flush.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            </a>
                            @else
                                <img src="/images/flush.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            @endif
                        </div>
                        <div class="col score {{ $stats["player_A"]["flush"] < $stats["player_B"]["flush"] ? 'winner' : '' }}">{{ $stats["player_B"]["flush"] }}</div>
                    </div>
                    <div class="row">
                        <div class="col score {{ $stats["player_A"]["straight"] > $stats["player_B"]["straight"] ? 'winner' : '' }}">{{ $stats["player_A"]["straight"] }}</div>
                        <div class="col-6">
                            @if ($stats["player_A"]["straight"] + $stats["player_B"]["straight"] > 0)
                            <a href="/games/50">
                                <img src="/images/straight.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            </a>
                            @else
                                <img src="/images/straight.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            @endif
                        </div>
                        <div class="col score {{ $stats["player_A"]["straight"] < $stats["player_B"]["straight"] ? 'winner' : '' }}">{{ $stats["player_B"]["straight"] }}</div>
                    </div>
                    <div class="row">
                        <div class="col score {{ $stats["player_A"]["three_of_a_kind"] > $stats["player_B"]["three_of_a_kind"] ? 'winner' : '' }}">{{ $stats["player_A"]["three_of_a_kind"] }}</div>
                        <div class="col-6">
                            @if ($stats["player_A"]["three_of_a_kind"] + $stats["player_B"]["three_of_a_kind"] > 0)
                            <a href="/games/40">
                                <img src="/images/three_of_a_kind.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            </a>
                            @else
                                <img src="/images/three_of_a_kind.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            @endif
                        </div>
                        <div class="col score {{ $stats["player_A"]["three_of_a_kind"] < $stats["player_B"]["three_of_a_kind"] ? 'winner' : '' }}">{{ $stats["player_B"]["three_of_a_kind"] }}</div>
                    </div>
                    <div class="row">
                        <div class="col score {{ $stats["player_A"]["two_pair"] > $stats["player_B"]["two_pair"] ? 'winner' : '' }}">{{ $stats["player_A"]["two_pair"] }}</div>
                        <div class="col-6">
                            @if ($stats["player_A"]["two_pair"] + $stats["player_B"]["two_pair"] > 0)
                            <a href="/games/30">
                                <img src="/images/two_pair.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            </a>
                            @else
                                <img src="/images/two_pair.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            @endif
                        </div>
                        <div class="col score {{ $stats["player_A"]["two_pair"] < $stats["player_B"]["two_pair"] ? 'winner' : '' }}">{{ $stats["player_B"]["two_pair"] }}</div>
                    </div>
                    <div class="row">
                        <div class="col score {{ $stats["player_A"]["one_pair"] > $stats["player_B"]["one_pair"] ? 'winner' : '' }}">{{ $stats["player_A"]["one_pair"] }}</div>
                        <div class="col-6">
                            @if ($stats["player_A"]["one_pair"] + $stats["player_B"]["one_pair"] > 0)
                            <a href="/games/20">
                                <img src="/images/one_pair.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            </a>
                            @else
                                <img src="/images/one_pair.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            @endif
                        </div>
                        <div class="col score {{ $stats["player_A"]["one_pair"] < $stats["player_B"]["one_pair"] ? 'winner' : '' }}">{{ $stats["player_B"]["one_pair"] }}</div>
                    </div>
                    <div class="row">
                        <div class="col score {{ $stats["player_A"]["high_card"] > $stats["player_B"]["high_card"] ? 'winner' : '' }}">{{ $stats["player_A"]["high_card"] }}</div>
                        <div class="col-6">
                            @if ($stats["player_A"]["high_card"] + $stats["player_B"]["high_card"] > 0)
                            <a href="/games/10">
                                <img src="/images/high_card.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            </a>
                            @else
                                <img src="/images/high_card.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            @endif
                        </div>
                        <div class="col score {{ $stats["player_A"]["high_card"] < $stats["player_B"]["high_card"] ? 'winner' : '' }}">{{ $stats["player_B"]["high_card"] }}</div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row btn-block text-right">
                        <a class="btn btn-primary" href="{{ route('home') }}">Back to home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
