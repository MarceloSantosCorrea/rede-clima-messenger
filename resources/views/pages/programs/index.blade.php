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
                    <h4 class="page-title">Listagem de Programas</h4>
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
                                <a href="{{ route('web.programs.create') }}" class="btn btn-danger waves-effect waves-light mb-2">
                                    <i class="mdi mdi-plus-circle mr-1"></i> Novo Programa
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Slogan</th>
                                    <th>Apresentador</th>
                                    <th class="text-right">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data)
                                    @foreach($data as $program)
                                        <tr>
                                            <td>{{ $program->name }}</td>
                                            <td>{{ $program->slogan }}</td>
                                            <td>{{ $program->presenter }}</td>
                                            <td class="text-right">
                                                @if(!$program->is_admin)
                                                    <a href="{{ route('web.programs.edit', $program->uid) }}" class="action-icon">
                                                        <i class="mdi mdi-square-edit-outline"></i>
                                                    </a>

                                                    <a href="javascript:void(0)" onclick="confirmation('{{ $program->name }}', 'program-delete-form-{{$program->uid}}')" class="action-icon">
                                                        <i class="mdi mdi-delete"></i>
                                                    </a>
                                                    <form id="program-delete-form-{{$program->uid}}" action="{{ route('web.programs.destroy', $program->uid) }}" method="POST" class="form-hidden">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="fixed-table-pagination text-center">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/confirmation.js?v1.0.0') }}"></script>
@endpush

