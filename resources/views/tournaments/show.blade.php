<x-base-layout>
    <style>
        .bracket-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .match-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 2px solid #e0e0e0;
        }
        .match-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .match-card.final {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            border-color: #ffc107;
        }
        .team-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            margin-bottom: 8px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }
        .team-name {
            font-weight: 600;
            color: #2d3748;
            font-size: 14px;
        }
        .score-input {
            width: 50px;
            height: 40px;
            text-align: center;
            border: 2px solid #667eea;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            color: #667eea;
        }
        .score-display {
            font-size: 20px;
            font-weight: bold;
            color: #667eea;
            min-width: 30px;
            text-align: center;
        }
        .update-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            border: none;
            width: 100%;
            margin-top: 10px;
        }
        .update-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .match-info {
            text-align: center;
            padding-top: 12px;
            border-top: 1px solid #e0e0e0;
            margin-top: 10px;
            color: #6c757d;
            font-size: 12px;
            font-weight: 500;
        }
        .round-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: white;
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .bracket-line {
            border-color: rgba(255, 255, 255, 0.4);
            border-width: 3px;
        }
        .bracket-connector {
            position: relative;
        }
        .bracket-connector::before {
            content: '';
            position: absolute;
            width: 40px;
            height: 2px;
            background: rgba(255, 255, 255, 0.5);
            top: 50%;
            right: -40px;
        }
        .rounds-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 80px;
        }
        .round-column {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        .matches-group {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }
        .semi-matches {
            gap: 160px;
        }
        .final-match {
            margin-top: 120px;
        }
        .page-title {
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            color: white;
            margin-bottom: 40px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        .archive-btn {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-block;
            text-align: center;
            margin-top: 20px;
        }
        .archive-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(245, 158, 11, 0.4);
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bracket-container">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="page-title" style="margin-bottom: 0;">
                        {{ $tournament->name }} - Speelschema Play-offs
                    </h2>
                    @auth
                        @if(Auth::user()->is_admin && !$tournament->archived)
                            <form action="{{ route('tournaments.archive', $tournament) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit toernooi wilt archiveren?');">
                                @csrf
                                <button type="submit" class="archive-btn">Toernooi Afsluiten</button>
                            </form>
                        @endif
                    @endauth
                </div>

                @if($playoffMatches->isEmpty())
                        <p class="text-white text-center">Er zijn nog geen play-off wedstrijden gegenereerd.</p>
                    @else
                        <div class="rounds-container">
                            <!-- Quarter Finals -->
                            <div class="round-column">
                                <h4 class="round-title">Kwartfinales</h4>
                                <div class="matches-group">
                                    @foreach($playoffMatches->where('round', 'quarter')->sortBy('id') as $match)
                                        <div class="match-card w-80 relative z-10 bracket-connector">
                                            @auth
                                                @if(Auth::user()->is_admin && !$tournament->archived)
                                                    <form action="{{ route('matches.update', $match) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        @if($match->team1 && $match->team2)
                                                            <div class="team-row" style="cursor: pointer;" onclick="this.querySelector('input[type=radio]').checked = true">
                                                                <div class="flex items-center gap-3">
                                                                    <input type="radio" name="winner_id" value="{{ $match->team1->id }}" {{ $match->team_1_score > $match->team_2_score ? 'checked' : '' }} class="w-5 h-5 text-purple-600">
                                                                    <span class="team-name">{{ $match->team1->name }}</span>
                                                                </div>
                                                                @if($match->team_1_score !== null)
                                                                    <span class="score-display">{{ $match->team_1_score > $match->team_2_score ? '✓' : '' }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="team-row" style="cursor: pointer;" onclick="this.querySelector('input[type=radio]').checked = true">
                                                                <div class="flex items-center gap-3">
                                                                    <input type="radio" name="winner_id" value="{{ $match->team2->id }}" {{ $match->team_2_score > $match->team_1_score ? 'checked' : '' }} class="w-5 h-5 text-purple-600">
                                                                    <span class="team-name">{{ $match->team2->name }}</span>
                                                                </div>
                                                                @if($match->team_2_score !== null)
                                                                    <span class="score-display">{{ $match->team_2_score > $match->team_1_score ? '✓' : '' }}</span>
                                                                @endif
                                                            </div>
                                                            <button type="submit" class="update-btn">Selecteer Winnaar</button>
                                                        @else
                                                            <div class="team-row">
                                                                <span class="team-name">{{ $match->team1 ? $match->team1->name : 'TBD' }}</span>
                                                            </div>
                                                            <div class="team-row">
                                                                <span class="team-name">{{ $match->team2 ? $match->team2->name : 'TBD' }}</span>
                                                            </div>
                                                        @endif
                                                    </form>
                                                @else
                                                    <div class="team-row">
                                                        <span class="team-name">{{ $match->team1 ? $match->team1->name : 'TBD' }}</span>
                                                        <span class="score-display">{{ $match->team_1_score ?? '-' }}</span>
                                                    </div>
                                                    <div class="team-row">
                                                        <span class="team-name">{{ $match->team2 ? $match->team2->name : 'TBD' }}</span>
                                                        <span class="score-display">{{ $match->team_2_score ?? '-' }}</span>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="team-row">
                                                    <span class="team-name">{{ $match->team1 ? $match->team1->name : 'TBD' }}</span>
                                                    <span class="score-display">{{ $match->team_1_score ?? '-' }}</span>
                                                </div>
                                                <div class="team-row">
                                                    <span class="team-name">{{ $match->team2 ? $match->team2->name : 'TBD' }}</span>
                                                    <span class="score-display">{{ $match->team_2_score ?? '-' }}</span>
                                                </div>
                                            @endauth
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Semi Finals -->
                            <div class="round-column">
                                <h4 class="round-title">Halve Finales</h4>
                                <div class="matches-group semi-matches">
                                    @foreach($playoffMatches->where('round', 'semi')->sortBy('id') as $match)
                                        <div class="match-card w-80 relative z-10 bracket-connector">
                                            @auth
                                                @if(Auth::user()->is_admin && !$tournament->archived)
                                                    <form action="{{ route('matches.update', $match) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        @if($match->team1 && $match->team2)
                                                            <div class="team-row" style="cursor: pointer;" onclick="this.querySelector('input[type=radio]').checked = true">
                                                                <div class="flex items-center gap-3">
                                                                    <input type="radio" name="winner_id" value="{{ $match->team1->id }}" {{ $match->team_1_score > $match->team_2_score ? 'checked' : '' }} class="w-5 h-5 text-purple-600">
                                                                    <span class="team-name">{{ $match->team1->name }}</span>
                                                                </div>
                                                                @if($match->team_1_score !== null)
                                                                    <span class="score-display">{{ $match->team_1_score > $match->team_2_score ? '✓' : '' }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="team-row" style="cursor: pointer;" onclick="this.querySelector('input[type=radio]').checked = true">
                                                                <div class="flex items-center gap-3">
                                                                    <input type="radio" name="winner_id" value="{{ $match->team2->id }}" {{ $match->team_2_score > $match->team_1_score ? 'checked' : '' }} class="w-5 h-5 text-purple-600">
                                                                    <span class="team-name">{{ $match->team2->name }}</span>
                                                                </div>
                                                                @if($match->team_2_score !== null)
                                                                    <span class="score-display">{{ $match->team_2_score > $match->team_1_score ? '✓' : '' }}</span>
                                                                @endif
                                                            </div>
                                                            <button type="submit" class="update-btn">Selecteer Winnaar</button>
                                                        @else
                                                            <div class="team-row">
                                                                <span class="team-name">{{ $match->team1 ? $match->team1->name : 'TBD' }}</span>
                                                            </div>
                                                            <div class="team-row">
                                                                <span class="team-name">{{ $match->team2 ? $match->team2->name : 'TBD' }}</span>
                                                            </div>
                                                        @endif
                                                    </form>
                                                @else
                                                    <div class="team-row">
                                                        <span class="team-name">{{ $match->team1 ? $match->team1->name : 'TBD' }}</span>
                                                        <span class="score-display">{{ $match->team_1_score ?? '-' }}</span>
                                                    </div>
                                                    <div class="team-row">
                                                        <span class="team-name">{{ $match->team2 ? $match->team2->name : 'TBD' }}</span>
                                                        <span class="score-display">{{ $match->team_2_score ?? '-' }}</span>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="team-row">
                                                    <span class="team-name">{{ $match->team1 ? $match->team1->name : 'TBD' }}</span>
                                                    <span class="score-display">{{ $match->team_1_score ?? '-' }}</span>
                                                </div>
                                                <div class="team-row">
                                                    <span class="team-name">{{ $match->team2 ? $match->team2->name : 'TBD' }}</span>
                                                    <span class="score-display">{{ $match->team_2_score ?? '-' }}</span>
                                                </div>
                                            @endauth
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Final -->
                            <div class="round-column">
                                <h4 class="round-title">Finale</h4>
                                <div class="matches-group final-match">
                                        @foreach($playoffMatches->where('round', 'final') as $match)
                                        <div class="match-card final w-80 relative z-10">
                                            @auth
                                                @if(Auth::user()->is_admin && !$tournament->archived)
                                                    <form action="{{ route('matches.update', $match) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        @if($match->team1 && $match->team2)
                                                            <div class="team-row" style="cursor: pointer;" onclick="this.querySelector('input[type=radio]').checked = true">
                                                                <div class="flex items-center gap-3">
                                                                    <input type="radio" name="winner_id" value="{{ $match->team1->id }}" {{ $match->team_1_score > $match->team_2_score ? 'checked' : '' }} class="w-5 h-5 text-purple-600">
                                                                    <span class="team-name">{{ $match->team1->name }}</span>
                                                                </div>
                                                                @if($match->team_1_score !== null)
                                                                    <span class="score-display">{{ $match->team_1_score > $match->team_2_score ? '🏆' : '' }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="team-row" style="cursor: pointer;" onclick="this.querySelector('input[type=radio]').checked = true">
                                                                <div class="flex items-center gap-3">
                                                                    <input type="radio" name="winner_id" value="{{ $match->team2->id }}" {{ $match->team_2_score > $match->team_1_score ? 'checked' : '' }} class="w-5 h-5 text-purple-600">
                                                                    <span class="team-name">{{ $match->team2->name }}</span>
                                                                </div>
                                                                @if($match->team_2_score !== null)
                                                                    <span class="score-display">{{ $match->team_2_score > $match->team_1_score ? '🏆' : '' }}</span>
                                                                @endif
                                                            </div>
                                                            <button type="submit" class="update-btn">Selecteer Winnaar</button>
                                                        @else
                                                            <div class="team-row">
                                                                <span class="team-name">{{ $match->team1 ? $match->team1->name : 'TBD' }}</span>
                                                            </div>
                                                            <div class="team-row">
                                                                <span class="team-name">{{ $match->team2 ? $match->team2->name : 'TBD' }}</span>
                                                            </div>
                                                        @endif
                                                    </form>
                                                @else
                                                    <div class="team-row">
                                                        <span class="team-name">{{ $match->team1 ? $match->team1->name : 'TBD' }}</span>
                                                        <span class="score-display">{{ $match->team_1_score ?? '-' }}</span>
                                                    </div>
                                                    <div class="team-row">
                                                        <span class="team-name">{{ $match->team2 ? $match->team2->name : 'TBD' }}</span>
                                                        <span class="score-display">{{ $match->team_2_score ?? '-' }}</span>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="team-row">
                                                    <span class="team-name">{{ $match->team1 ? $match->team1->name : 'TBD' }}</span>
                                                    <span class="score-display">{{ $match->team_1_score ?? '-' }}</span>
                                                </div>
                                                <div class="team-row">
                                                    <span class="team-name">{{ $match->team2 ? $match->team2->name : 'TBD' }}</span>
                                                    <span class="score-display">{{ $match->team_2_score ?? '-' }}</span>
                                                </div>
                                            @endauth
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
            </div>
        </div>
    </div>
</x-base-layout>
