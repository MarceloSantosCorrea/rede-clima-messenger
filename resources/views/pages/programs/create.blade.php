@extends('layouts.app')
@section('title', 'Novo Programa')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('web.programs.index') }}">Programas</a></li>
                            <li class="breadcrumb-item active">Novo</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Criar Novo Programa</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('web.programs.store') }}">
                            @csrf
                            @include('pages.programs._form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection