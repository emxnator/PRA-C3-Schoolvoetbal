<x-base-layout>
    <div class="home-container">
        <section class="hero-section">
            <h1>Onze Toernooien</h1>
            <p>Bekijk alle aankomende voetbal en lijnbal toernooien</p>
        </section>

        @if($tournaments->count() > 0)
            <section class="tournaments-grid">
                @foreach($tournaments as $tournament)
                    <div class="tournament-card">
                        <div class="tournament-header">
                            <h2>{{ $tournament->name }}</h2>
                            <span class="tournament-date">{{ $tournament->datum->format('d-m-Y') }}</span>
                        </div>
                        
                        <div class="tournament-details">
                            <div class="detail-item">
                                <span class="detail-label">Datum:</span>
                                <span class="detail-value">{{ $tournament->datum->format('l, d F Y') }}</span>
                            </div>
                            
                            <div class="detail-item">
                                <span class="detail-label">Velden:</span>
                                <span class="detail-value">{{ $tournament->fields_amount }}</span>
                            </div>
                            
                            <div class="detail-item">
                                <span class="detail-label">Wedstrijdduur:</span>
                                <span class="detail-value">{{ $tournament->game_length_minutes }} minuten</span>
                            </div>
                            
                            <div class="detail-item">
                                <span class="detail-label">Aantal teams:</span>
                                <span class="detail-value">{{ $tournament->random_pool_teams_count }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>
        @else
            <section class="no-tournaments">
                <p>Er zijn momenteel geen aankomende toernooien beschikbaar.</p>
            </section>
        @endif
    </div>
</x-base-layout>
