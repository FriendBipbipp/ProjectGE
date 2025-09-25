<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function CustomScore()
    {
        
        return view('CustomScore');
    }

    public function CalculateScore(Request $request)
    {
        $distance = $request->input('distance');
        $bow_type = $request->input('bow_type');
        $arrows = $request->input('arrows'); 

        
        return view('CalculateScore', compact('distance', 'bow_type', 'arrows'));
    }
}
