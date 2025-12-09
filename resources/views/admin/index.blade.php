<x-base-layout>
    <div class="admin-panel">
        <h1>Admin Panel</h1>
        
        <div class="admin-section">
            <h2>Geregistreerde gebruikers</h2>
            
            @if($users->count() > 0)
                <div class="users-table">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Naam</th>
                                <th>Email</th>
                                <th>Telefoon</th>
                                <th>Rol</th>
                                <th>Registratiedatum</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phonenumber ?? 'Niet opgegeven' }}</td>
                                    <td>
                                        @if($user->is_admin)
                                            <span class="badge-admin">Beheerder</span>
                                            @if($user->id !== Auth::id() && Auth::user()->is_super_admin)
                                                <form method="POST" action="{{ route('admin.toggle', $user->id) }}" style="display: inline; margin-left: 10px;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn-toggle-admin">Verwijder admin</button>
                                                </form>
                                            @endif
                                        @else
                                            <span class="badge-user">Gebruiker</span>
                                            @if($user->id !== Auth::id() && Auth::user()->is_super_admin)
                                                <form method="POST" action="{{ route('admin.toggle', $user->id) }}" style="display: inline; margin-left: 10px;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn-toggle-admin">Maak admin</button>
                                                </form>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="no-users">Geen geregistreerde gebruikers</p>
            @endif
        </div>
    </div>
</x-base-layout>
