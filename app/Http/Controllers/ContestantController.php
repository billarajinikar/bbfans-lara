<?php
namespace App\Http\Controllers;

use App\Models\Contestant;
use Illuminate\Http\Request;

class ContestantController extends Controller
{
    public function index()
    {
        $contestants = Contestant::get();
        return view('home', compact('contestants'));
    }

    public function show($id)
    {
        $contestant = Contestant::with('media')->findOrFail($id);
        return view('contestant.show', compact('contestant'));
    }
}
