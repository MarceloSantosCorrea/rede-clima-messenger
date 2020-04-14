@extends('layouts.app')
@section('title', 'Usuários')
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
                    <h4 class="page-title">Listagem de Usuários do Painel</h4>
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
                                <a href="{{ route('web.users.create') }}" class="btn btn-danger waves-effect waves-light mb-2">
                                    <i class="mdi mdi-plus-circle mr-1"></i> Novo Usuário
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Criado Em</th>
                                    <th>Status</th>
                                    <th class="text-right">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data)
                                    @foreach($data as $user)
                                        <tr>
                                            <td class="table-user">
                                                @if($user->thumbnail)
                                                    <img src="{{ url("storage/thumbnails/{$user->thumbnail}") }}" alt="table-user" class="mr-2 rounded-circle">
                                                @endif
                                                <a href="javascript:void(0);" class="text-body font-weight-semibold">{{ $user->name }}</a>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->format('d/m/Y H:i:s') }}</td>
                                            <td>
                                                <span class="badge bg-soft-success text-success shadow-lg">Ativo</span>
                                            </td>
                                            <td class="text-right">
                                                @if(!$user->is_admin)
                                                    <a href="{{ route('web.users.edit', $user->uid) }}" class="action-icon">
                                                        <i class="mdi mdi-square-edit-outline"></i>
                                                    </a>

                                                    <a href="javascript:void(0)" onclick="confirmation('{{ $user->name }}', 'user-delete-form-{{$user->uid}}')" class="action-icon">
                                                        <i class="mdi mdi-delete"></i>
                                                    </a>
                                                    <form id="user-delete-form-{{$user->uid}}" action="{{ route('web.users.destroy', $user->uid) }}" method="POST" class="form-hidden">
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
    <script src="{{ asset('assets/js/confirmation.js?v1.0.0', true) }}"></script>
@endpush

