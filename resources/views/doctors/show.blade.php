@extends('layouts.sidebar')

@section('content')
<div class="topbar">
    <div class="breadcrumb">
        <a href="{{ route('doctors.index') }}">Médecins</a>
        <span class="sep">›</span>
        <span>Détails du Docteur</span>
    </div>
    <a href="{{ route('doctors.index') }}" class="btn-back">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        Retour à la liste
    </a>
</div>

<div class="doctor-details-container">
    <div class="details-card">
        <div class="card-header">
            <div class="doctor-avatar">
                <svg viewBox="0 0 24 24" width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>
            <div class="header-info">
                <h2>{{ $doctor->name }}</h2>
                <span class="badge-specialty">{{ $doctor->specialty }}</span>
            </div>
        </div>

        <div class="card-body">
            <div class="info-grid">
                <div class="info-item">
                    <label>Email professionnel</label>
                    <div class="value">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        {{ $doctor->email }}
                    </div>
                </div>

                <div class="info-item">
                    <label>Téléphone</label>
                    <div class="value">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        {{ $doctor->phone ?? 'Non renseigné' }}
                    </div>
                </div>

                <div class="info-item">
                    <label>Spécialité</label>
                    <div class="value">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg>
                        {{ $doctor->specialty }}
                    </div>
                </div>

                <div class="info-item">
                    <label>Date d'inscription</label>
                    <div class="value">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        {{ $doctor->created_at->format('d/m/Y') }}
                    </div>
                </div>
            </div>
            
            @if($doctor->address)
            <div class="info-item full-width">
                <label>Adresse professionnelle</label>
                <div class="value">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    {{ $doctor->address }}
                </div>
            </div>
            @endif
        </div>
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
  --border:         #dce8e1;
  --bg-field:       #f4f7f5;
  --ease:           cubic-bezier(.4,0,.2,1);
}

body {
    font-family: 'Outfit', sans-serif;
    background-color: #f8faf9;
    color: var(--text-primary);
}

.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 0;
    margin-bottom: 30px;
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

.btn-back {
    display: flex;
    align-items: center;
    gap: 8px;
    background: white;
    color: var(--text-secondary);
    padding: 10px 18px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 500;
    border: 1px solid var(--border);
    transition: all var(--ease);
}

.btn-back:hover {
    background: var(--bg-field);
    color: var(--accent);
    border-color: var(--accent-mid);
    transform: translateX(-4px);
}

.doctor-details-container {
    max-width: 900px;
    margin: 0 auto;
}

.details-card {
    background: white;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(0,0,0,0.04);
    border: 1px solid var(--border);
}

.card-header {
    background: linear-gradient(135deg, var(--accent-light) 0%, #f8faf9 100%);
    padding: 40px;
    display: flex;
    align-items: center;
    gap: 30px;
    border-bottom: 1px solid var(--border);
}

.doctor-avatar {
    width: 100px;
    height: 100px;
    background: white;
    border-radius: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--accent);
    box-shadow: 0 10px 25px var(--accent-glow);
    border: 1px solid var(--accent-mid);
}

.header-info h2 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 8px;
    color: var(--text-primary);
}

.badge-specialty {
    background: var(--accent);
    color: white;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
    display: inline-block;
}

.card-body {
    padding: 40px;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
}

.info-item label {
    display: block;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--text-muted);
    margin-bottom: 10px;
}

.info-item .value {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 1.1rem;
    color: var(--text-secondary);
    font-weight: 500;
}

.info-item .value svg {
    color: var(--accent);
}

.full-width {
    grid-column: 1 / -1;
    margin-top: 20px;
    padding-top: 30px;
    border-top: 1px solid var(--bg-field);
}

@media (max-width: 640px) {
    .card-header {
        flex-direction: column;
        text-align: center;
        padding: 30px;
    }
    .info-grid {
        grid-template-columns: 1fr;
    }
    .header-info h2 {
        font-size: 1.5rem;
    }
}
</style>
@endsection
