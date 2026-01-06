<x-base-layout>
    <div class="home-container">
    <section class="hero-section">
        <h1>Onze Wedstrijden</h1>
        <p>Bekijk alle wedstrijden</p>
    </section>

    <section class="matches-grid">
        @foreach($matches as $match)
            <div class="match-card">
                <div class="match-header">
                    <h2>Match: {{ $match->id }}</h2>
                    <span class="match-date">{{ $match->start_time->format('d-m-Y H:i') }}</span>
                </div>
                
                <div class="match-details">
                    <div class="detail-details">
                        <span class="detail-label">Toernooi:</span>
                        <span class="detail-value">{{ $match->tournament->name ?? '-' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Team 1 Score:</span>
                        <span class="detail-value">{{ $match->team_1_score ?? '-' }}</span>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-label">Team 2 Score:</span>
                        <span class="detail-value">{{ $match->team_2_score ?? '-' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Veld:</span>
                        <span class="detail-value">{{ $match->field }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Scheidsrechter:</span>
                        <span class="detail-value">{{ $match->referee }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Type:</span>
                        <span class="detail-value">{{ $match->type }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Starttijd:</span>
                        <span class="detail-value">{{ $match->start_time->format('H:i') }}</span>
                    </div>
                </div>

                @auth
                    @if(auth()->user()->is_admin || auth()->user()->is_super_admin)
                        <div class="match-actions">
                            <form action="{{ route('matches.destroy', $match->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-delete" type="submit">DELETE</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        @endforeach
    </section>
    </div>
</x-base-layout>
