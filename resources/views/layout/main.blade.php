@extends('layout.root')

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
@endsection

@section('header')
     <div class="container">
        <div class="row">
            <div>@include('layout.navbar')</div>
        </div>
@endsection

@section('footer')
    <div class="container">
        <div class="row">
            <div>@include('layout.footer')</div>
        </div>
    </div>
@endsection