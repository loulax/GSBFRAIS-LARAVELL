@extends('layouts.master')

@section('content')
    <h1>Authentification</h1>

    <div class="card p-4 mt-3">
        <form method="POST" action="{{ url('/authentifier') }}">
            @csrf

            <div class="mb-3">
                <label for="login" class="form-label">Identifiant</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="votre identifiant" required>
            </div>

            <div class="mb-3">
                <label for="pwd" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="pwd" name="pwd" placeholder="votre mot de passe" required>
            </div>

            <hr>

            <button type="submit" class="btn btn-primary">Se connecter</button>
            <a href="{{ url('/') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>

    @if(isset($erreur))
        <div class="alert alert-danger mt-3" role="alert">{{ $erreur }}</div>
    @endif
@endsection
