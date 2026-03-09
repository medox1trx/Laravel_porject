@extends('layouts.sidebar')

@section('title', 'Dossier Patient — ' . $patient->first_name . ' ' . $patient->last_name)

@section('content')
<div class="patient-details-wrapper">
    <!-- Topbar Actions -->
    <div class="topbar">
        <div class="breadcrumb">
            <a href="{{ route('patients.index') }}">Patients</a>
            <span class="sep">›</span>
            <span class="current">Dossier Patient</span>
        </div>

        <div class="action-group">
            <a href="{{ route('prescriptions.create', ['patient_id' => $patient->id]) }}" class="btn-secondary">
                <svg viewbox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/></svg>
                Nouvelle Ordonnance
            </a>
            <a href="{{ route('patients.edit', $patient->id) }}" class="btn-primary">
                <svg viewbox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Modifier
            </a>
        </div>
    </div>

    <!-- Patient Header Card -->
    <div class="patient-header-card">
        <div class="profile-main">
            <div class="avatar-container">
                @if($patient->photo)
                    <img src="{{ asset($patient->photo) }}" class="avatar-large" alt="Photo patient">
                @else
                    <div class="avatar-placeholder">
                        {{ strtoupper(substr($patient->first_name, 0, 1) . substr($patient->last_name, 0, 1)) }}
                    </div>
                @endif
            </div>
            <div class="identity-info">
                <div class="name-badge-row">
                    <h1>{{ $patient->first_name }} {{ $patient->last_name }}</h1>
                    <span class="status-pill {{ $patient->is_majeur ? 'majeur' : 'mineur' }}">
                        {{ $patient->is_majeur ? 'Majeur' : 'Mineur' }}
                    </span>
                </div>
                <div class="meta-info">
                    <span class="meta-item">
                        <strong>CIN:</strong> {{ $patient->cin ?? 'Non renseigné' }}
                    </span>
                    <span class="meta-sep">•</span>
                    <span class="meta-item">
                        <strong>Né(e) le:</strong> {{ \Carbon\Carbon::parse($patient->birth_date)->format('d/m/Y') }}
                    </span>
                </div>
            </div>
        </div>
        <div class="header-stats">
            <div class="mini-stat">
                <span class="label">Groupe Sanguin</span>
                <span class="value blood">{{ $patient->groupe_sanguin ?? '—' }}</span>
            </div>
            <div class="mini-stat">
                <span class="label">Assurance</span>
                <span class="value">{{ $patient->assurance ?? 'Aucune' }}</span>
            </div>
        </div>
    </div>

    <!-- Details Grid -->
    <div class="details-grid">
        <!-- Contact & Info -->
        <div class="info-panel">
            <div class="panel-header">
                <svg viewbox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <h3>Informations Personnelles</h3>
            </div>
            <div class="info-list">
                <div class="info-item">
                    <span class="label">Sexe</span>
                    <span class="value">{{ $patient->gender == 'male' ? 'Masculin' : 'Féminin' }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Téléphone</span>
                    <span class="value highlight">{{ $patient->phone ?? '—' }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Email</span>
                    <span class="value">{{ $patient->email ?? '—' }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Nationalité</span>
                    <span class="value">{{ $patient->nationality ?? 'Marocaine' }}</span>
                </div>
            </div>
        </div>

        @if(!$patient->is_majeur)
        <!-- Responsible Party -->
        <div class="info-panel responsible-panel">
            <div class="panel-header">
                <svg viewbox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                <h3>Responsable Légal</h3>
            </div>
            <div class="info-list">
                <div class="info-item">
                    <span class="label">Type / Relation</span>
                    <span class="value">{{ $patient->type_responsable }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Nom complet</span>
                    <span class="value">{{ $patient->nom_responsable }} {{ $patient->prenom_responsable }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Téléphone</span>
                    <span class="value highlight">{{ $patient->phone_responsable }}</span>
                </div>
                <div class="info-item">
                    <span class="label">CIN Responsable</span>
                    <span class="value mono">{{ $patient->cin_responsable }}</span>
                </div>
            </div>
        </div>
        @endif

        <!-- Medical & Insurance Details -->
        <div class="info-panel">
            <div class="panel-header">
                <svg viewbox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                <h3>Dossier Médical</h3>
            </div>
            <div class="info-list">
                <div class="info-item">
                    <span class="label">Assurance</span>
                    <span class="value">{{ $patient->assurance ?? 'Aucune' }}</span>
                </div>
                <div class="info-item">
                    <span class="label">N° Assurance</span>
                    <span class="value mono">{{ $patient->num_assurance ?? '—' }}</span>
                </div>
            </div>
        </div>

        <!-- Medical History (Full Width) -->
        <div class="info-panel full-width">
            <div class="panel-header">
                <svg viewbox="0 0 24 24"><path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg>
                <h3>Antécédents & Remarques</h3>
            </div>
            <div class="medical-data-grid">
                <div class="data-block">
                    <h4>Antécédents Personnels</h4>
                    <p>{{ $patient->antecedents_personnels ?? 'Néant' }}</p>
                </div>
                <div class="data-block">
                    <h4>Antécédents Familiaux</h4>
                    <p>{{ $patient->antecedents_familiaux ?? 'Néant' }}</p>
                </div>
                <div class="data-block">
                    <h4>Allergies</h4>
                    <p class="warning-text">{{ $patient->allergies ?? 'Aucune' }}</p>
                </div>
                <div class="data-block">
                    <h4>Note Psychomoteur</h4>
                    <p>{{ $patient->developpement_psychomoteur ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
      --accent: #3a7d5c;
      --accent-light: #eaf3ee;
      --accent-dark: #2a6048;
      --text-primary: #1a2b22;
      --text-secondary: #4a6358;
      --text-muted: #8aad9c;
      --border: #dce8e1;
      --bg-field: #f4f7f5;
      --shadow-soft: 0 10px 25px -5px rgba(0,0,0,0.05);
      --ease: cubic-bezier(0.4, 0, 0.2, 1);
    }

    .patient-details-wrapper { padding: 32px; font-family: 'Plus Jakarta Sans', sans-serif; }

    /* Topbar */
    .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; }
    .breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 0.9rem; }
    .breadcrumb a { color: var(--text-muted); text-decoration: none; transition: 0.2s; }
    .breadcrumb a:hover { color: var(--accent); }
    .breadcrumb .sep { color: var(--border); }
    .breadcrumb .current { color: var(--text-primary); font-weight: 600; }

    .action-group { display: flex; gap: 12px; }
    .btn-primary, .btn-secondary { display: flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: 12px; font-weight: 600; text-decoration: none; transition: 0.2s var(--ease); }
    
    .btn-primary { background: var(--accent); color: white; box-shadow: 0 4px 12px rgba(58,125,92,0.2); }
    .btn-primary:hover { background: var(--accent-dark); transform: translateY(-2px); }
    
    .btn-secondary { background: white; color: var(--text-primary); border: 1px solid var(--border); }
    .btn-secondary:hover { background: var(--bg-field); border-color: var(--accent-mid); }
    
    .btn-primary svg, .btn-secondary svg { width: 18px; height: 18px; fill: none; stroke: currentColor; stroke-width: 2; }

    /* Header Card */
    .patient-header-card {
        background: white; padding: 32px; border-radius: 24px; border: 1px solid var(--border);
        display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;
        box-shadow: var(--shadow-soft);
    }

    .profile-main { display: flex; align-items: center; gap: 24px; }
    .avatar-large { width: 96px; height: 96px; border-radius: 24px; object-fit: cover; border: 4px solid var(--accent-light); }
    .avatar-placeholder { width: 96px; height: 96px; border-radius: 24px; background: var(--accent-light); color: var(--accent); display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 700; border: 4px solid var(--accent-light); }

    .identity-info h1 { font-size: 2rem; font-weight: 800; color: var(--text-primary); margin: 0; }
    .name-badge-row { display: flex; align-items: center; gap: 16px; margin-bottom: 8px; }
    
    .status-pill { padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
    .status-pill.majeur { background: #dcfce7; color: #15803d; }
    .status-pill.mineur { background: #fef9c3; color: #a16207; }

    .meta-info { display: flex; align-items: center; gap: 12px; color: var(--text-secondary); font-size: 0.95rem; }
    .meta-sep { color: var(--border); }

    .header-stats { display: flex; gap: 40px; }
    .mini-stat { display: flex; flex-direction: column; gap: 4px; }
    .mini-stat .label { font-size: 0.75rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; }
    .mini-stat .value { font-size: 1.1rem; font-weight: 700; color: var(--text-primary); }
    .mini-stat .value.blood { color: #dc2626; }

    /* Grid Layout */
    .details-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; }
    .info-panel { background: white; padding: 24px; border-radius: 20px; border: 1px solid var(--border); box-shadow: var(--shadow-soft); }
    .info-panel.full-width { grid-column: span 2; }

    .panel-header { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid var(--bg-field); }
    .panel-header svg { width: 22px; height: 22px; fill: none; stroke: var(--accent); stroke-width: 2; }
    .panel-header h3 { font-size: 1.1rem; font-weight: 700; margin: 0; color: var(--text-primary); }

    .info-list { display: flex; flex-direction: column; gap: 12px; }
    .info-item { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px dashed var(--bg-field); }
    .info-item:last-child { border: none; }
    .info-item .label { color: var(--text-secondary); font-weight: 500; font-size: 0.95rem; }
    .info-item .value { color: var(--text-primary); font-weight: 600; font-size: 0.95rem; }
    .info-item .value.highlight { color: var(--accent); }
    .info-item .value.mono { font-family: 'JetBrains Mono', monospace; font-size: 0.85rem; }

    .medical-data-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 32px; }
    .data-block h4 { font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; }
    .data-block p { font-size: 0.95rem; line-height: 1.6; color: var(--text-secondary); margin: 0; }
    .warning-text { color: #dc2626 !important; font-weight: 600; }

    @media (max-width: 900px) {
        .patient-header-card { flex-direction: column; align-items: flex-start; gap: 24px; }
        .details-grid { grid-template-columns: 1fr; }
        .info-panel.full-width { grid-column: auto; }
        .medical-data-grid { grid-template-columns: 1fr; gap: 24px; }
    }
</style>
@endsection
