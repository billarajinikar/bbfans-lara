@extends('layouts.app')

@section('title', 'Contestants')

@section('content')
    <div class="container mt-2 mb-5">
        <div class="text-center mb-4">
            <h2>Welcome to the Telugu Bigg Boss Fans.</h2>
        </div>

        @if ($activePoll)
            <div class="card mx-auto shadow-sm" style="max-width: 600px;">
                <div class="card-body">
                    <h3 class="card-title text-center">{{ $activePoll->title }}</h3>
                    <p class="text-center">Voting is open from {{ $activePoll->start_at }} to {{ $activePoll->end_at }}.</p>
                    @if (!$hasVoted)
                    <form action="{{ route('polls.vote', $activePoll->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="contestant_id" class="form-label">Select Contestant</label>
                            @foreach ($activePoll->contestants as $contestant)
                                <div class="form-check mb-3">
                                    <input  class="form-check-input radio-large" type="radio" name="contestant_id" id="contestant{{ $contestant->id }}" value="{{ $contestant->id }}" required>
                                    <label class="form-check-label fs-4" for="contestant{{ $contestant->id }}">
                                        {{ $contestant->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-grid col-6 mx-auto">
                            <button type="submit" class="btn btn-primary btn-block">Submit Vote</button>
                        </div>
                    </form>
                    @else
                        <!-- Show results after voting -->
                        <h4 class="text-center mt-4">Poll Results</h4>
                        <ul class="list-group">
                            @foreach ($results as $result)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $result['name'] }}
                                    <span class="badge bg-primary rounded-pill">{{ $result['votes'] }} votes</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        @else
            <div class="alert alert-warning text-center" role="alert">
                <p>No active polls at the moment. Please check back later!</p>
            </div>
        @endif
    </div>

<!-- Display the full list of contestants with voting phone numbers -->
<h3 class="text-center mb-4">Telugu Bigg Boss Season 8 - Contestants Full List With Voting Phone Numbers</h3>

<div class="row">
    @foreach($contestants as $contestant)
        <?php
        $phoneNumber = $contestant->voting_phone;
        $formattedPhoneNumber = str_replace(' ', '', $phoneNumber);  // Remove spaces for 'tel:' link
        ?>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $contestant->name }}</h5>
                    <p class="card-text">
                        Voting Phone: <a href="tel:{{ $formattedPhoneNumber }}">{{ $phoneNumber }}</a>
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection