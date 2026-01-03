<?php

namespace App\Http\Controllers;

use App\Models\MatchModel;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function update(Request $request, MatchModel $match)
    {
        $validated = $request->validate([
            'winner_id' => 'required|integer',
        ]);

        $winnerId = $validated['winner_id'];
        
        // Set scores based on winner (winner gets 1, loser gets 0)
        if ($winnerId == $match->team_1_id) {
            $match->update([
                'team_1_score' => 1,
                'team_2_score' => 0,
            ]);
        } elseif ($winnerId == $match->team_2_id) {
            $match->update([
                'team_1_score' => 0,
                'team_2_score' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Winnaar succesvol geselecteerd.');
    }
}
