<x-base-layout>
    <div class="home-container">
        <section class="hero-section">
            <h1>Schoolvoetbal Toernooien</h1>
            <p>Voetbal & Lijnbal competities voor leerlingen in Bergen op Zoom en omgeving</p>
        </section>

        <section class="sports-grid">
            <div class="sport-card voetbal">
                <h2>Voetbal</h2>
                <p>
                    We organiseren voetbaltoernooien voor verschillende leeftijdsgroepen van groep 3 t/m de 1e klas middelbare school.
                </p>
                <ul>
                    <li>Groep 3/4 (gemengd)</li>
                    <li>Groep 5/6 (gemengd)</li>
                    <li>Groep 7/8 (gemengd)</li>
                    <li>1e klas (jongens/gemengd)</li>
                    <li>1e klas (meiden)</li>
                </ul>
            </div>

            <div class="sport-card lijnbal">
                <h2>Lijnbal</h2>
                <p>
                    Spannende lijnbal competities speciaal voor meisjes in de hogere groepen en 1e klas middelbare school.
                </p>
                <ul>
                    <li>Groep 7/8 (meiden)</li>
                    <li>1e klas (meiden)</li>
                    <li>Indoor competities</li>
                    <li>Professionele begeleiding</li>
                </ul>
            </div>
        </section>

        
        <section class="events-section">
            <h2>Onze Toernooien</h2>
            
            <div class="events-list">
                @forelse($upcomingTournaments as $tournament)
                    <div class="event-card {{ str_contains(strtolower($tournament->name), 'lijnbal') ? 'lijnbal' : 'voetbal' }}">
                        <h3>{{ $tournament->name }}</h3>
                        <p><strong>Datum:</strong> {{ $tournament->datum->format('d F Y') }}</p>
                        <p><strong>Locatie:</strong> Bergen op Zoom en omgeving</p>
                        <p><strong>Velden:</strong> {{ $tournament->fields_amount }} | <strong>Wedstrijdduur:</strong> {{ $tournament->game_length_minutes }} min</p>
                    </div>
                @empty
                    <div class="event-card voetbal">
                        <h3>Voetbal Groep 3/4 (gemengd)</h3>
                        <p><strong>Locatie:</strong> Bergen op Zoom en omgeving</p>
                        <p>Speciaal toernooi voor de jongste voetballers</p>
                    </div>

                    <div class="event-card voetbal">
                        <h3>Voetbal Groep 5/6 (gemengd)</h3>
                        <p><strong>Locatie:</strong> Bergen op Zoom en omgeving</p>
                        <p>Competitie voor de middenbouw</p>
                    </div>

                    <div class="event-card voetbal">
                        <h3>Voetbal Groep 7/8 (gemengd)</h3>
                        <p><strong>Locatie:</strong> Bergen op Zoom en omgeving</p>
                        <p>Toernooi voor bovenbouw leerlingen</p>
                    </div>
                @endforelse
            </div>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('toernooien') }}" style="display: inline-block; background: #8a2be2; color: white; padding: 15px 40px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                    Bekijk alle toernooien
                </a>
            </div>
        </section>
        
        <section class="stats-section" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 40px;">
            <div class="stat-card" style="background: white; padding: 30px; border-radius: 10px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                <div style="font-size: 3em; color: #8a2be2; font-weight: bold;">{{ $totalSchools }}</div>
                <div style="color: #666; margin-top: 10px;">Scholen</div>
            </div>
            <div class="stat-card" style="background: white; padding: 30px; border-radius: 10px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                <div style="font-size: 3em; color: #4b0082; font-weight: bold;">{{ $totalTeams }}</div>
                <div style="color: #666; margin-top: 10px;">Teams</div>
            </div>
            <div class="stat-card" style="background: white; padding: 30px; border-radius: 10px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                <div style="font-size: 3em; color: #8a2be2; font-weight: bold;">{{ $totalTournaments }}</div>
                <div style="color: #666; margin-top: 10px;">Toernooien</div>
            </div>
        </section>
    </div>
</x-base-layout>
