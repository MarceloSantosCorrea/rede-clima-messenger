@extends('layouts.app')
@section('title', 'Comentários')
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
                    <h4 class="page-title">Listagem de Comentários do Painel</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped mb-0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Criado Em</th>
                                    <th class="text-right">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data)
                                    @foreach($data as $comment)
                                        <tr>
                                            <td>
                                                <img src="{{ url("storage/{$comment->lead->thumbnail}") }}"
                                                     height="35" class="d-flex mr-2 rounded-circle"
                                                     onerror="this.onerror=null; this.src='https://scontent.xx.fbcdn.net/v/t31.0-1/cp0/c15.0.50.50a/p50x50/10733713_10150004552801937_4553731092814901385_o.jpg?_nc_cat=1&_nc_ohc=Z0EnNwcnLIwAX-ZCG75&_nc_ht=scontent.xx&oh=45778c01f08bb6b9dd3f0737d76a60ef&oe=5F018ED4'"
                                                >
                                            </td>
                                            <td>{{ $comment->lead->name }}</td>
                                            <td>{{ $comment->lead->email }}</td>
                                            <td>{{ $comment->created_at->format('d/m/Y H:i:s') }}</td>
                                            <td class="text-right">
                                                <a href="javascript:void(0)" onclick="confirmation('esta mensagem', 'comment-delete-form-{{$comment->uid}}')" class="action-icon">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                                <form id="comment-delete-form-{{$comment->uid}}" action="{{ route('web.comments.destroy', $comment->uid) }}" method="POST" class="form-hidden">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">{{ $comment->comment }}</td>
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

