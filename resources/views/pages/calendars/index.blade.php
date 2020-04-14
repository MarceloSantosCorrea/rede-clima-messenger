@extends('layouts.app')
@section('title', 'Programas')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Lista</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Programação</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right">
                                <a href="{{ route('web.calendars.create') }}" class="btn btn-danger waves-effect waves-light mb-2">
                                    <i class="mdi mdi-plus-circle mr-1"></i> Adiconar Programação
                                </a>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#sunday" data-toggle="tab" aria-expanded="false" class="nav-link active">Domingo</a>
                        </li>
                        <li class="nav-item">
                            <a href="#monday" data-toggle="tab" aria-expanded="true" class="nav-link">Segunda</a>
                        </li>
                        <li class="nav-item">
                            <a href="#tuesday" data-toggle="tab" aria-expanded="false" class="nav-link">Terça</a>
                        </li>
                        <li class="nav-item">
                            <a href="#wednesday" data-toggle="tab" aria-expanded="false" class="nav-link">Quarta</a>
                        </li>
                        <li class="nav-item">
                            <a href="#thursday" data-toggle="tab" aria-expanded="false" class="nav-link">Quinta</a>
                        </li>
                        <li class="nav-item">
                            <a href="#friday" data-toggle="tab" aria-expanded="false" class="nav-link">Sexta</a>
                        </li>
                        <li class="nav-item">
                            <a href="#saturday" data-toggle="tab" aria-expanded="false" class="nav-link">Sábado</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="sunday">
                            @include('pages.calendars.table-calendars', ['data' => $data['Dom'] ?? []])
                        </div>
                        <div class="tab-pane" id="monday">
                            @include('pages.calendars.table-calendars', ['data' => $data['Seg'] ?? []])
                        </div>
                        <div class="tab-pane" id="tuesday">
                            @include('pages.calendars.table-calendars', ['data' => $data['Ter'] ?? []])
                        </div>
                        <div class="tab-pane" id="wednesday">
                            @include('pages.calendars.table-calendars', ['data' => $data['Qua'] ?? []])
                        </div>
                        <div class="tab-pane" id="thursday">
                            @include('pages.calendars.table-calendars', ['data' => $data['Qui'] ?? []])
                        </div>
                        <div class="tab-pane" id="friday">
                            @include('pages.calendars.table-calendars', ['data' => $data['Sex'] ?? []])
                        </div>
                        <div class="tab-pane" id="saturday">
                            @include('pages.calendars.table-calendars', ['data' => $data['Sáb'] ?? []])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/confirmation.js?v1.0.0', true) }}"></script>
@endpush

