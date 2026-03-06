@extends('layouts.sidebar')

@section('title', 'Aperçu Ordonnance')

@section('content')
<style>
    .show-container { padding: 40px; max-width: 900px; margin: 0 auto; }
    
    .prescription-card {
        background: #fff;
        padding: 50px;
        border-radius: 4px;
        box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
        border: 1px solid #e2e8f0;
        position: relative;
        min-height: 800px;
        display: flex;
        flex-direction: column;
    }

    .doc-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 50px;
        padding-bottom: 25px;
        border-bottom: 2px solid #3A7D5C;
    }

    .clinic-info h1 { font-size: 24px; color: #3A7D5C; font-weight: 800; margin-bottom: 5px; }
    .clinic-info p { font-size: 13px; color: #64748b; margin: 0; }

    .doctor-info { text-align: right; }
    .doctor-info h2 { font-size: 18px; color: #1e293b; font-weight: 700; margin-bottom: 5px; }

    .patient-section {
        background: #f8fafc;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 40px;
        display: grid;
        grid-template-columns: 2fr 1fr;
    }

    .label { font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px; display: block; }
    .value { font-size: 15px; color: #1e293b; font-weight: 600; }

    .ordonnance-label {
        font-size: 32px;
        font-family: 'Fraunces', serif;
        color: #1e293b;
        text-align: center;
        margin-bottom: 40px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .meds-list { flex: 1; }
    .med-item { margin-bottom: 25px; border-left: 3px solid #3A7D5C; padding-left: 20px; }
    .med-name { font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 5px; }
    .med-dosage { font-size: 14px; color: #475569; font-style: italic; }

    .footer {
        margin-top: 50px;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }

    .signature {
        text-align: center;
        border-top: 1px dashed #cbd5e1;
        padding-top: 10px;
        width: 200px;
    }

    .action-bar {
        display: flex;
        gap: 12px;
        margin-top: 30px;
        justify-content: center;
    }

    .btn-print {
        background: #1e293b;
        color: #fff;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        transition: 0.2s;
    }
    .btn-print:hover { background: #0f172a; }
</style>

<div class="show-container">
    <div class="prescription-card" id="prescription">
        <div class="doc-header">
            <div class="clinic-info">
                <h1>MediCal Cabinet</h1>
                <p>123 Avenue des Oliviers, Casablanca</p>
                <p>Tél: +212 5 22 00 00 00</p>
                <p>contact@medical.ma</p>
            </div>
            <div class="doctor-info">
                <h2>Dr. {{ $prescription->doctor->name }}</h2>
                <p style="color:#64748b; font-size: 13px;">Médecin Généraliste</p>
            </div>
        </div>

        <div class="patient-section">
            <div>
                <span class="label">Patient</span>
                <span class="value">{{ $prescription->patient->first_name }} {{ $prescription->patient->last_name }}</span>
            </div>
            <div style="text-align: right;">
                <span class="label">Date</span>
                <span class="value">{{ \Carbon\Carbon::parse($prescription->prescription_date)->format('d/m/Y') }}</span>
            </div>
        </div>

        <h3 class="ordonnance-label">Ordonnance</h3>

        <div class="meds-list">
            @foreach($prescription->items as $item)
            <div class="med-item">
                <div class="med-name">{{ $item->medicine_name }}</div>
                <div class="med-dosage">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; vertical-align: middle; margin-right: 5px;"><polyline points="20 6 9 17 4 12"/></svg>
                    Posologie: {{ $item->dosage }}
                    @if($item->duration)
                        | Durée: {{ $item->duration }}
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        @if($prescription->notes)
        <div style="background: #fffbeb; border: 1px solid #fef3c7; padding: 15px; border-radius: 8px; margin-top: 30px;">
            <span class="label" style="color: #92400e;">Observations</span>
            <p style="color: #92400e; font-size: 13px; margin: 5px 0 0;">{{ $prescription->notes }}</p>
        </div>
        @endif

        <div class="footer">
            <div style="font-size: 11px; color: #94a3b8;">
                Généré via MediCal le {{ now()->format('d/m/Y à H:i') }}
            </div>
            <div class="signature">
                <span style="font-size: 11px; color: #64748b;">Cachet et Signature du Médecin</span>
                <div style="height: 60px;"></div>
            </div>
        </div>
    </div>

    <div class="action-bar">
        <a href="{{ route('prescriptions.print', $prescription->id) }}" class="btn-print" target="_blank">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px;"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
            Imprimer l'Ordonnance
        </a>
        <a href="{{ route('prescriptions.index') }}" class="btn" style="border: 1px solid #e2e8f0; color: #64748b; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 500;">
            Retour à la liste
        </a>
    </div>
</div>
@endsection
