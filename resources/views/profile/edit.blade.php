@extends('layouts.sidebar')

@section('title', 'Mon Profil')

@section('content')
<link rel="stylesheet" href="{{ asset('asset/css/style_profile.css') }}">

<div class="profile-container">
    <div class="profile-header">
        <h1 class="profile-title">Mon Profil</h1>
        <p class="text-secondary">Gérez vos informations personnelles et votre photo de profil.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="profile-card">
        <div class="profile-grid">
            <!-- Photo de Profil -->
            <div class="photo-section">
                <h3>Photo de profil</h3>
                @if($user->profile_photo)
                    <img src="{{ asset('profiles/' . $user->profile_photo) }}" alt="Photo de profil" class="current-photo" id="photo-preview">
                @else
                    <div class="photo-placeholder" id="photo-preview">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                @endif
                
                <div class="photo-actions">
                    <label for="profile_photo" class="upload-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 5px;">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="17 8 12 3 7 8"></polyline>
                            <line x1="12" y1="3" x2="12" y2="15"></line>
                        </svg>
                        Modifier la photo
                    </label>

                    @if($user->profile_photo)
                        <form action="{{ route('profile.photo.delete_action') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre photo de profil ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-photo-btn">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 5px;">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                                Supprimer la photo
                            </button>
                        </form>
                    @endif
                </div>
                @error('profile_photo')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Informations Personnelles -->
            <div class="form-section">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h3>Informations personnelles</h3>
                    
                    <input type="file" name="profile_photo" id="profile_photo" onchange="previewImage(this)" style="display: none;">

                    <div class="form-group">
                        <label for="name">Nom complet</label>
                        <input type="text" name="name" id="name" class="form-input @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Adresse e-mail</label>
                        <input type="email" name="email" id="email" class="form-input @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Téléphone (Ex: 0612345678)</label>
                        <input type="text" name="phone" id="phone" class="form-input @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" placeholder="06XXXXXXXX" pattern="^(05|06|07)\d{8}$" title="Format: 05, 06 ou 07 suivi de 8 chiffres" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        @error('phone')
                            <div class="error-message">Le numéro doit être au format marocain (ex: 0612345678).</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Adresse</label>
                        <textarea name="address" id="address" class="form-input @error('address') is-invalid @enderror" rows="3">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="submit-btn" style="margin-top: 2rem;">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var preview = document.getElementById('photo-preview');
                if (preview.tagName === 'IMG') {
                    preview.src = e.target.result;
                } else {
                    // Replace placeholder div with img
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'current-photo';
                    img.id = 'photo-preview';
                    preview.parentNode.replaceChild(img, preview);
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
