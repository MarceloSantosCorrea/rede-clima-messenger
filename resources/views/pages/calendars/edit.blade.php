@extends('layouts.app')
@section('title', 'Editar Programação')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('web.calendars.index') }}">Programação</a>
                            </li>
                            <li class="breadcrumb-item active">Editar</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Editar Programação</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('web.calendars.update', $model->uid) }}">
                            @csrf
                            @method('put')
                            @include('pages.calendars._form')
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection