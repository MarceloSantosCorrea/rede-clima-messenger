@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <div class="container-fluid">

        <div class="row mt-3">
            <div class="col-md-4">
                <div class="card-box bg-pattern">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-md bg-blue rounded shadow-lg">
                                <i class="fe-users avatar-title font-22 text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark my-1">
                                    <span data-plugin="counterup">{{ \App\Models\User::count() }}</span></h3>
                                <p class="text-muted mb-0 text-truncate">Usuários</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-box bg-pattern">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-md bg-success rounded shadow-lg">
                                <i class="mdi mdi-filter avatar-title font-22 text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark my-1">
                                    <span data-plugin="counterup">{{ \App\Models\Lead::count() }}</span></h3>
                                <p class="text-muted mb-0 text-truncate">Clientes</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-box-->
            </div> <!-- end col -->
            <div class="col-md-4">
                <div class="card-box bg-pattern">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-md bg-danger rounded shadow-lg">
                                <i class="mdi mdi-comment avatar-title font-22 text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark my-1">
                                    <span data-plugin="counterup">{{ \App\Models\Comment::count() }}</span>
                                </h3>
                                <p class="text-muted mb-0 text-truncate">Comentários</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-box-->
            </div> <!-- end col -->
        </div>

    </div> <!-- container -->
@endsection