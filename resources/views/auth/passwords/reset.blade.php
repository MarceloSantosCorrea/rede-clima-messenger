@extends('layouts.auth')

@section('content')
    <div class="wrapper-page">
        <div class="card-box">
            <div class="panel-heading">
                <h3 class="text-center">
                    <strong class="text-custom">P</strong>izza
                    <strong class="text-custom">P</strong>lace
                </h3>
            </div>
            <div class="p-20">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="form-horizontal m-t-20" method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-12">
                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="col-12">
                            <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Senha" required autofocus>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <div class="col-12">
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Senha" required autofocus>

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group text-center m-t-40">
                        <div class="col-12">
                            <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit"> Alterar Senha
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
