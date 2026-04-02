@extends('layout.main')

@section('title', 'Главная')

@section('content')
    <div class="container mt-1 pt-1">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1 class="display-4 mb-2">Добро пожаловать в Глэмпинг</h1>
                <p class="lead">Наслаждайтесь комфортом на лоне природы</p>
            </div>
        </div>
    </div>
    @include('components.cards')
@endsection