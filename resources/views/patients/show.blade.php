@extends('layouts.sidebar')

@section('title', 'Dossier Patient')

@section('content')
<link rel="stylesheet" href="{{ asset('asset/css/style_ajouterPatient.css') }}">
<style>
    .show-container { padding: 40px; max-width: 1000px; margin: 0 auto; }
    .header-info { display: flex; align-items: center; gap: 24px; margin-bottom: 40px; }
    .avatar-large { width: 100px; height: 100px; border-radius: 24px; object-fit: cover; }
    .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; }
    .info-card { background: #fff; padding: 24px; border-radius: 16px; border: 1px solid #eef2f6; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05); }
    .info-card h3 { font-size: 14px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }
    .info-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f8fafc; }
    .info-row:last-child { border: none; }
    .info-label { color: #64748b; font-size: 14px; }
    .info-value { font-weight: 500; color: #1e293b; font-size: 14px; }
    .btn-actions { display: flex; gap: 12px; margin-top: 24px; }
    .btn-prescription {
        background: #3A7D5C;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        transition: opacity 0.2s;
    }
    .btn-prescription:hover { opacity: 0.9; }
</style>

<div class="patient-details" style="padding: 24px; max-width: 1200px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h1 style="font-size: 24px; font-weight: 700; color: #111827;">Détails du Patient</h1>
        <div style="display: flex; gap: 12px;">
            <a href="{{ route('prescriptions.create', ['patient_id' => $patient->id]) }}" class="btn-prescription">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 18px;"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/></svg>
                Nouvelle Ordonnance
            </a>
            <a href="{{ route('patients.edit', $patient->id) }}" class="btn-prescription" style="background: #2563eb;">Modifier</a>
        </div>
    </div>
    <div class="header-info">
        <img src="{{ asset($patient->photo ?? 'asset/img/default-avatar.png') }}" class="avatar-large">
        <div style="flex: 1;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <h1 style="font-size: 32px; font-weight: 700; color: #1e293b;">{{ $patient->first_name }} {{ $patient->last_name }}</h1>
                <span class="status-badge {{ $patient->is_majeur ? 'status-majeur' : 'status-mineur' }}">
                    {{ $patient->is_majeur ? 'Majeur' : 'Mineur' }}
                </span>
            </div>
            <p style="color: #64748b; margin-top: 4px;">CIN: {{ $patient->cin ?? 'N/A' }} | Date de naissance: {{ \Carbon\Carbon::parse($patient->birth_date)->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>

    <div class="info-grid">
        <div class="info-card">
            <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px;"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg> Informations Personnelles</h3>
            <div class="info-row"><span class="info-label">Sexe</span><span class="info-value">{{ $patient->gender == 'male' ? 'Masculin' : 'Féminin' }}</span></div>
            <div class="info-row"><span class="info-label">Téléphone</span><span class="info-value">{{ $patient->phone ?? 'N/A' }}</span></div>
            <div class="info-row"><span class="info-label">Email</span><span class="info-value">{{ $patient->email ?? 'N/A' }}</span></div>
            <div class="info-row"><span class="info-label">Nationalité</span><span class="info-value">{{ $patient->nationality ?? 'Marocaine' }}</span></div>
        </div>

        @if(!$patient->is_majeur)
        <div class="info-card">
            <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px;"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg> Responsable Légale</h3>
            <div class="info-row"><span class="info-label">Type</span><span class="info-value">{{ $patient->type_responsable }}</span></div>
            <div class="info-row"><span class="info-label">Nom complet</span><span class="info-value">{{ $patient->nom_responsable }} {{ $patient->prenom_responsable }}</span></div>
            <div class="info-row"><span class="info-label">Téléphone</span><span class="info-value">{{ $patient->phone_responsable }}</span></div>
            <div class="info-row"><span class="info-label">CIN</span><span class="info-value">{{ $patient->cin_responsable }}</span></div>
        </div>
        @endif

        <div class="info-card">
            <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px;"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Médical & Assurance</h3>
            <div class="info-row"><span class="info-label">Groupe Sanguin</span><span class="info-value">{{ $patient->groupe_sanguin ?? 'Non spécifié' }}</span></div>
            <div class="info-row"><span class="info-label">Assurance</span><span class="info-value">{{ $patient->assurance ?? 'Aucune' }}</span></div>
            <div class="info-row"><span class="info-label">Numéro Assurance</span><span class="info-value">{{ $patient->num_assurance ?? 'N/A' }}</span></div>
        </div>

        <div class="info-card" style="grid-column: span 2;">
            <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 16px;"><path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg> Antécédents & Notes</h3>
            <div class="info-row"><span class="info-label">Antécédents Personnels</span><span class="info-value">{{ $patient->antecedents_personnels ?? 'Néant' }}</span></div>
            <div class="info-row"><span class="info-label">Antécédents Familiaux</span><span class="info-value">{{ $patient->antecedents_familiaux ?? 'Néant' }}</span></div>
            <div class="info-row"><span class="info-label">Allergies</span><span class="info-value">{{ $patient->allergies ?? 'Aucune' }}</span></div>
            <div class="info-row"><span class="info-label">Psychomoteur</span><span class="info-value">{{ $patient->developpement_psychomoteur ?? 'N/A' }}</span></div>
        </div>
    </div>
</div>
@endsection
