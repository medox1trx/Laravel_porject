@extends('layouts.sidebar')

@section('title', 'Modifier Utilisateur')

@section('content')
<link rel="stylesheet" href="{{ asset('asset/css/style_dashboard_admin.css') }}">
<link rel="stylesheet" href="{{ asset('asset/css/style_edit_user.css') }}">


<div class="main-user-admin">
  <header class="topbar">
    <div class="topbar-left">
      <div class="topbar-title">Modifier Utilisateur</div>
      <div class="breadcrumb">
        <a href="{{ route('dashboard') }}">Dashboard</a><span>›</span>
        <a href="{{ route('utilisateurs.index') }}">Utilisateurs</a><span>›</span>
        <span>{{ $utilisateur->name }}</span><span>›</span>
        <span>Modifier</span>
      </div>
    </div>
  </header>

  <div class="content">
    <div class="form-card">
      <div class="form-card-header">
        <div class="form-card-icon" style="background: rgba(245,158,11,0.1);">✏️</div>
        <div>
          <div class="form-card-title">Modifier l'utilisateur</div>
          <div class="form-card-subtitle">Mettez à jour les informations de cet utilisateur</div>
        </div>
      </div>

      <form method="POST" action="{{ route('utilisateurs.update', $utilisateur) }}">
        @csrf
        @method('PUT')
        <div class="form-card-body">

          <!-- User banner -->
          <div class="user-edit-banner">
            <div class="user-edit-avatar avatar-{{ $utilisateur->role }}">{{ strtoupper(substr($utilisateur->name, 0, 2)) }}</div>
            <div>
              <div class="user-edit-name">{{ $utilisateur->name }}</div>
              <div class="user-edit-email">{{ $utilisateur->email }}</div>
              <div class="user-edit-id">#U-{{ str_pad($utilisateur->id, 4, '0', STR_PAD_LEFT) }} · Créé le {{ $utilisateur->created_at ? $utilisateur->created_at->format('d/m/Y') : '—' }}</div>
            </div>
          </div>

          @if($errors->any())
          <div class="alert-errors">
            <div class="alert-errors-title">⚠️ Des erreurs ont été détectées</div>
            <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <div class="form-group">
            <label class="form-label">Nom complet</label>
            <input type="text" name="name" class="form-input {{ $errors->has('name') ? 'error' : '' }}" value="{{ old('name', $utilisateur->name) }}" required>
            @error('name') <div class="form-error">⚠ {{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label class="form-label">Adresse email</label>
            <input type="email" name="email" class="form-input {{ $errors->has('email') ? 'error' : '' }}" value="{{ old('email', $utilisateur->email) }}" required>
            @error('email') <div class="form-error">⚠ {{ $message }}</div> @enderror
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Nouveau mot de passe</label>
              <input type="password" name="password" class="form-input {{ $errors->has('password') ? 'error' : '' }}" placeholder="Laisser vide pour ne pas changer">
              @error('password') <div class="form-error">⚠ {{ $message }}</div> @enderror
              <div class="form-hint">💡 Laisser vide pour conserver le mot de passe actuel</div>
            </div>
            <div class="form-group">
              <label class="form-label">Confirmation</label>
              <input type="password" name="password_confirmation" class="form-input" placeholder="Confirmer le mot de passe">
            </div>
          </div>

          <div class="form-group" id="phone-group">
            <label class="form-label">Téléphone</label>
            <input type="text" name="phone" id="phone" class="form-input {{ $errors->has('phone') ? 'error' : '' }}" value="{{ old('phone', $utilisateur->phone) }}">
            @error('phone') <div class="form-error">⚠ {{ $message }}</div> @enderror
          </div>

          <div class="form-group" id="specialty-group" style="display: none;">
            <label class="form-label">Spécialité</label>
            <input type="text" name="specialty" id="specialty" class="form-input {{ $errors->has('specialty') ? 'error' : '' }}" value="{{ old('specialty', $utilisateur->specialty) }}">
            @error('specialty') <div class="form-error">⚠ {{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label class="form-label">Rôle</label>
            <div class="role-options">
              <label class="role-option">
                <input type="radio" name="role" value="admin" {{ old('role', $utilisateur->role) === 'admin' ? 'checked' : '' }} onchange="toggleDoctorFields()">
                <div class="role-option-card">
                  <span class="role-option-icon">🔐</span>
                  <div>
                    <div class="role-option-name">Administrateur</div>
                    <div class="role-option-desc">Accès complet</div>
                  </div>
                </div>
              </label>
              <label class="role-option">
                <input type="radio" name="role" value="doctor" {{ old('role', $utilisateur->role) === 'doctor' ? 'checked' : '' }} onchange="toggleDoctorFields()">
                <div class="role-option-card">
                  <span class="role-option-icon">🩺</span>
                  <div>
                    <div class="role-option-name">Médecin</div>
                    <div class="role-option-desc">Gestion patients</div>
                  </div>
                </div>
              </label>
              <label class="role-option">
                <input type="radio" name="role" value="nurse" {{ old('role', $utilisateur->role) === 'nurse' ? 'checked' : '' }} onchange="toggleDoctorFields()">
                <div class="role-option-card">
                  <span class="role-option-icon">💉</span>
                  <div>
                    <div class="role-option-name">Infirmier</div>
                    <div class="role-option-desc">Soins & suivi</div>
                  </div>
                </div>
              </label>
              <label class="role-option">
                <input type="radio" name="role" value="secretary" {{ old('role', $utilisateur->role) === 'secretary' ? 'checked' : '' }} onchange="toggleDoctorFields()">
                <div class="role-option-card">
                  <span class="role-option-icon">📋</span>
                  <div>
                    <div class="role-option-name">Secrétaire</div>
                    <div class="role-option-desc">Rendez-vous</div>
                  </div>
                </div>
              </label>
            </div>
            @error('role') <div class="form-error">⚠ {{ $message }}</div> @enderror
          </div>
        </div>

        <script>
          function toggleDoctorFields() {
            const role = document.querySelector('input[name="role"]:checked').value;
            const specialtyGroup = document.getElementById('specialty-group');
            specialtyGroup.style.display = (role === 'doctor') ? 'block' : 'none';
          }
          document.addEventListener('DOMContentLoaded', toggleDoctorFields);
        </script>

        <div class="form-card-footer">
          <a href="{{ route('utilisateurs.index') }}" class="btn btn-outline">← Retour</a>
          <button type="submit" class="btn btn-primary">💾 Enregistrer les modifications</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
