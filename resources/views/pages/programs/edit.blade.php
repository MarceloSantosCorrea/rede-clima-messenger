@extends('layouts.app')
@section('title', 'Editar Programa')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('web.programs.index') }}">Programas</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Editar Dados do Programa - Criado em: {{ $model->created_at->format('d/m/Y H:i:s') }}</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('web.programs.update', $model->uid) }}">
                            @csrf
                            @method('put')
                            @include('pages.programs._form')
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection