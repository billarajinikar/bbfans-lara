<?php
namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function vote(Request $request)
    {
        // Validate the request
        $request->validate([
            'contestant_id' => 'required|exists:contestants,id'
        ]);

        // Record the vote
        Vote::create([
            'poll_id' => 1,
            'contestant_id' => $request->input('contestant_id'),
            'voter_ip' => $request->ip()
        ]);

        return redirect()->route('home')->with('success', 'Your vote has been cast successfully!');
    }
}