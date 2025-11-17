@extends('layout.main')

@section('title', 'Профиль')

@section('header')
     <div class="container">
        <div class="row">
          <a href="/" class="nav-link px-2 link-primary">< На главную</a></li>
        </div>
@endsection

@section('content')
    <div class="container mt-1 pt-1">
        <h3 class="mb-2">Профиль пользователя</h3>
    </div>
    @include('components.profile')
@endsection