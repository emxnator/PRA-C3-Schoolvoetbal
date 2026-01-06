<x-base-layout>
    <div class="home-container">
        <section class="hero-section">
            <h1>Onze Teamss</h1>
            <p>Bekijk alle Teams!</p>
        </section>

        @if($teams->count() > 0)
        <section class="team-grid">
            @foreach($teams as $team)
            <div class="team-card">
                <div class="team-header">
                    <h2>{{ $team->name }}</h2>
                    <span class="team-date">{{ $team->created_at->format('d-m-Y') }}</span>
                </div>
                <div class="team-details">
                    <div class="detail-item">
                        <span class="detail-label">Referee:</span>
                        <span class="detail-value">{{ $team->referee }}</span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">School:</span>
                        <span class="detail-value">{{ $team->school?->name }}</span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Pool:</span>
                        <span class="detail-value">{{ $team->pool?->name }}</span>
                    </div>
                </div>

                <!-- DELETE button for admins only -->
                @auth
                    @if(auth()->user()->is_admin || auth()->user()->is_super_admin)
                        <form action="{{ route('teams.destroy', $team->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete" type="submit">DELETE</button>
                        </form>
                    @endif
                @endauth
            </div>
            @endforeach
        </section>
        @else
        <section class="no-teams">
            <p>Er zijn momenteel geen aankomende toernooien beschikbaar.</p>
        </section>
        @endif
    </div>
</x-base-layout>
