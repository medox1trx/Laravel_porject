!


@extends('layouts.sidebar')

@section('content')
<div class="topbar">
    <div class="breadcrumb">
        <a href="{{ route('doctors.index') }}">Médecins</a>
        <span class="sep">›</span>
        <span>Liste</span>
    </div>
</div>

<div class="doctors-container">
    <div class="table-header">
        <h3>Liste des Docteurs</h3>
        <form action="{{ route('doctors.index') }}" method="GET" class="search-form">
            <input type="text" name="search" id="doctor-search" class="search-input" placeholder="Nom, Email, Spécialité..." value="{{ request('search') }}">
            <button type="submit" class="btn-search">Chercher</button>
            @if(request('search'))
                <a href="{{ route('doctors.index') }}" class="btn-reset">Réinitialiser</a>
            @endif
        </form>
    </div>

    <div class="table-responsive">
        <table class="doctors-table">
            <thead>
                <tr>
                    <th>Nom & Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Spécialité</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($doctors as $doctor)
                <tr>
                    <td class="col-name">{{ $doctor->name }}</td>
                    <td>{{ $doctor->email ?? 'N/A' }}</td>
                    <td>{{ $doctor->phone ?? 'N/A' }}</td>
                    <td><span class="badge-specialty">{{ $doctor->specialty }}</span></td>
                    <td>
                        <div class="action-icons">
                            <a href="{{ route('doctors.show', $doctor->id) }}" class="btn-action view" title="Voir">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="empty-state">Aucun docteur trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $doctors->appends(request()->query())->links() }}
    </div>
</div>

<style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap');

:root {
  --accent:         #3a7d5c;
  --accent-light:   #eaf3ee;
  --accent-mid:     #c4ddd0;
  --accent-glow:    rgba(58,125,92,.15);
  --accent-dark:    #2a6048;
  --text-primary:   #1a2b22;
  --text-secondary: #4a6358;
  --text-muted:     #8aad9c;
  --text-label:     #6b8c7d;
  --border:         #dce8e1;
  --bg-field:       #f4f7f5;
  --ease:           cubic-bezier(.4,0,.2,1);
}

*, *::before, *::after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
    font-family: 'Outfit', sans-serif;
    -webkit-font-smoothing: antialiased;
    background-color: #f8faf9;
    color: var(--text-primary);
}

.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 0;
    margin-bottom: 20px;
}

.breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.95rem;
    color: var(--text-muted);
}

.breadcrumb a {
    color: var(--accent);
    text-decoration: none;
    font-weight: 500;
}

.breadcrumb .sep {
    color: var(--text-muted);
}

.btn-new {
    display: flex;
    align-items: center;
    gap: 8px;
    background: var(--accent);
    color: white;
    padding: 10px 20px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 500;
    transition: all var(--ease);
    box-shadow: 0 4px 12px var(--accent-glow);
}

.btn-new:hover {
    background: var(--accent-dark);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px var(--accent-glow);
}

.doctors-container {
    background: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.04);
    border: 1px solid var(--border);
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    flex-wrap: wrap;
    gap: 15px;
}

.table-header h3 {
    font-size: 1.4rem;
    font-weight: 600;
    color: var(--text-primary);
}

.search-form {
    display: flex;
    gap: 10px;
    align-items: center;
}

.search-input {
    padding: 10px 16px;
    border: 1px solid var(--border);
    border-radius: 10px;
    background: var(--bg-field);
    color: var(--text-primary);
    outline: none;
    width: 250px;
    transition: all var(--ease);
    font-family: inherit;
}

.search-input:focus {
    border-color: var(--accent);
    background: white;
    box-shadow: 0 0 0 4px var(--accent-glow);
}

.btn-search {
    padding: 10px 18px;
    background: var(--accent);
    color: white;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 500;
    transition: all var(--ease);
}

.btn-search:hover {
    background: var(--accent-dark);
}

.btn-reset {
    font-size: 0.9rem;
    color: var(--text-muted);
    text-decoration: none;
    padding: 5px;
    transition: color var(--ease);
}

.btn-reset:hover {
    color: var(--text-secondary);
}

.table-responsive {
    overflow-x: auto;
    border-radius: 12px;
}

.doctors-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.doctors-table th {
    background: var(--bg-field);
    color: var(--text-label);
    padding: 16px;
    text-transform: uppercase;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-align: left;
    border-bottom: 1px solid var(--border);
}

.doctors-table td {
    padding: 18px 16px;
    border-bottom: 1px solid var(--border);
    vertical-align: middle;
    color: var(--text-secondary);
    transition: background-color 0.2s ease;
}

.doctors-table tr:last-child td {
    border-bottom: none;
}

.doctors-table tr:hover td {
    background-color: var(--accent-light);
}

.col-name {
    font-weight: 600;
    color: var(--text-primary) !important;
}

.badge-specialty {
    background: var(--accent-light);
    color: var(--accent);
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
}

.action-icons {
    display: flex;
    gap: 8px;
    justify-content: flex-end;
}

.btn-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: var(--bg-field);
    color: var(--text-secondary);
    text-decoration: none;
    transition: all var(--ease);
    border: none;
    cursor: pointer;
}

.btn-action:hover {
    background: var(--accent-mid);
    color: var(--accent-dark);
    transform: translateY(-2px);
}

.btn-action.delete:hover {
    background: #fee2e2;
    color: #cc2d2d;
}

.empty-state {
    text-align: center;
    padding: 50px !important;
    color: var(--text-muted);
    font-style: italic;
}

.pagination-wrapper {
    margin-top: 30px;
    display: flex;
    justify-content: center;
}

/* Custom Pagination Styling to match Medox UI */
.pagination {
    display: flex;
    list-style: none;
    gap: 8px;
}

.page-item .page-link {
    padding: 10px 16px;
    border-radius: 10px;
    background: white;
    border: 1px solid var(--border);
    color: var(--text-secondary);
    text-decoration: none;
    transition: all var(--ease);
}

.page-item.active .page-link {
    background: var(--accent);
    color: white;
    border-color: var(--accent);
}

.page-item .page-link:hover:not(.active) {
    background: var(--accent-light);
    border-color: var(--accent-mid);
}

@media (max-width: 768px) {
    .table-header {
        flex-direction: column;
        align-items: stretch;
    }
    .search-input {
        width: 100%;
    }
}
</style>
@endsection
