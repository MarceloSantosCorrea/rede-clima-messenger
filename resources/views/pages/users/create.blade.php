@extends('layouts.app')
@section('title', 'Novo Usuário')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('web.users.index') }}">Usuários</a></li>
                            <li class="breadcrumb-item active">Novo</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Criar Novo Usuário Para Acesso ao Painel</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('web.users.store') }}">
                            @csrf
                            @include('pages.users._form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection