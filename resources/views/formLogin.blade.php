@extends('layouts.master')

@section('content')
    <h2>Authentification</h2>

    <form method="POST" action="{{ url('/authentifier') }}" class="mt-3">
        @csrf

        <div class="mb-3">
            <label for="login" class="form-label">Identifiant</label>
            <input type="text" id="login" name="login" class="form-control" placeholder="votre identifiant" required>
        </div>

        <div class="mb-3">
            <label for="pwd" class="form-label">Mot de passe</label>
            <input type="password" id="pwd" name="pwd" class="form-control" placeholder="votre mot de passe" required>
        </div>

        <button type="submit" class="btn btn-primary">Se connecter</button>
        <a href="{{ url('/') }}" class="btn btn-secondary">Annuler</a>
    </form>

    @if(isset($erreur))
        <div class="alert alert-danger mt-3" role="alert">{{ $erreur }}</div>
    @endif
@endsection
