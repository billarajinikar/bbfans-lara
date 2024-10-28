@extends('layouts.app')

@section('title', 'Week 9 - Voting polls results')

@section('content')
    <div class="container mt-2 mb-5">
        <div class="text-center mb-4">
            <h2>Welcome to the Telugu Bigg Boss Fans.</h2>
        </div>

        @if ($activePoll)
            <div class="card mx-auto shadow-sm" style="max-width: 600px;">
                <div class="card-body">
                    <h3 class="card-title text-center">{{ $activePoll->title }}</h3>
                    <p class="text-center">Voting closes on {{ $activePoll->end_at }}.</p>
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
<div class="alert alert-info" role="alert">Thank you! You have already voted!</div>
<h4 class="text-center mt-4">Poll Results</h4>
<ul class="list-group">
    @foreach ($results as $index => $result)
        <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
                <b>{{ $result['name'] }}</b>
                <span class="badge bg-primary rounded-pill">{{ $result['percentage'] }}%</span>
            </div>
            <div class="progress mt-2">
                <div class="progress-bar 
                    @if ($index >= count($results) - 2)
                        @if ($index === count($results) - 1)
                            bg-danger  <!-- Lowest contestant -->
                        @else
                            bg-warning <!-- Second lowest contestant -->
                        @endif
                    @elseif ($result['percentage'] >= 75)
                        bg-success
                    @elseif ($result['percentage'] >= 50)
                        bg-info
                    @else
                        bg-primary
                    @endif
                " role="progressbar" style="width: {{ $result['percentage'] }}%;" aria-valuenow="{{ $result['percentage'] }}" aria-valuemin="0" aria-valuemax="100">
                    {{ $result['percentage'] }}%
                </div>
            </div>
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

    <h3>Today's promo - analysis</h3>
    <div class="row">
    <p>ఈరోజు తెలుగు బిగ్ బాస్ సీజన్ 8 ప్రోమోలలో మనం చాలా ఉత్కంఠభరితమైన క్షణాలను చూడవచ్చు. బిగ్ బాస్ చరిత్రలో మొదటిసారి మెగా చీఫ్‌కు ఐదుగురు కంటెస్టెంట్లను నామినేట్ చేసి, వారిని జైల్లో పెట్టే అధికారం ఉంది. మొదట గౌతమ్‌ను నామినేట్ చేయడం వల్ల గౌతమ్ మరియు విష్ణుప్రియ మధ్య తీవ్ర వాదన చోటుచేసుకుంది, దానికి యష్మి కూడా చేరింది. తరువాత పృధ్వి కూడా చర్చలో చేరడంతో మొత్తం విషయం గౌతమ్ మరియు పృధ్వి మధ్య మరింత ఉత్కంఠభరితంగా మారింది.
    </p>
<p>గౌతమ్ యష్మిని "అక్క" అని పిలిచాడు, ఇది ఆమెకు ఇష్టం లేదు. గౌతమ్ మధ్యలో ఎవరో ఉన్నారని సూచించాడు కానీ పేర్లు వెల్లడించలేదు. ఇంతలో పృధ్వి చర్చలు కూడా ఉత్కంఠను పెంచాయి. విష్ణుప్రియ తన సొంత క్లౌన్ సభ్యుడు నబీల్‌ను కూడా నామినేట్ చేయడంతో తీవ్ర చర్చలు చోటుచేసుకున్నాయి. నబీల్ తనపై ఆగ్రహంతో, "నాకు గత వారం మిర్చిని పట్టుకున్నాను, అందుకే ఈ వారం మీరు మెగా చీఫ్ అయ్యారు" అని చెప్పి, ఇది సరైనదికాదని, తనదైన వినోదాత్మక రీతిలో విష్ణుప్రియతో చర్చించాడు.
</p><p>
మూడో ప్రోమోలో, అద్భుతమైన ట్విస్ట్ కనిపించింది! హౌస్‌మేట్స్ నామినేట్ అయిన సభ్యులను రక్షించడానికి చిన్న టేబుల్ మీద ఉన్న మిర్చిని పట్టుకోవాలి. ప్రతి ఒక్కరు నామినేషన్‌లో ఉన్న వారిని సేవ్ చేయడానికి మరియు సురక్షితంగా ఉన్న వారిని నామినేషన్‌లో పెట్టడానికి పోరాడారు. రోహిణి మిర్చిని పట్టుకుని పృధ్విని నామినేషన్‌లోకి మార్చింది, తద్వారా గేమ్ మరింత ఉత్కంఠభరితంగా మారింది.
</p><p>
తీవ్ర చర్చలు, అనుకోని నామినేషన్లు, మరియు సొంత కంటెస్టెంట్లను సేవ్ చేయడానికి జరిగిన గట్టి పోటీతో ఈరోజు ఎపిసోడ్ ఎమోషన్స్ మరియు ఆశ్చర్యాలకు నిండిన రోలర్ కోస్టర్‌గా మారబోతుంది. మిస్సవ్వద్దు!
</p>    
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
