@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="text-center py-5 px-4 border rounded-3 shadow-sm bg-light">
            <h1 class="display-6 fw-bold mb-4">Bienvenue sur la boîte à idées</h1>

            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-success btn-lg">Accéder à vos idées</a>
            @endauth

            @guest
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Connexion</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg">S'inscrire</a>
                </div>
            @endguest
        </div>
    </div>
@endsection
