@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <a href="{{ route('login') }}">
                                <span><img src="https://redeclima.tv.br/wp-content/uploads/2019/09/news-log3.png" alt=""></span>
                            </a>
                            <p class="text-muted mb-4 mt-3">Entre com seu email e senha para acessar o painel.</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="emailaddress">E-mail</label>
                                <input class="form-control" type="email" id="emailaddress" required name="email" value="{{ old('email') }}" placeholder="Informe seu E-mail">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Senha</label>
                                <input class="form-control" type="password" required name="password" id="password" placeholder="Informe sua senha">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-signin" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="checkbox-signin">Lembrar me</label>
                                </div>
                            </div>
                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit"> Acessar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p>
                            <a href="{{ route('password.request') }}" class="text-white-50 ml-1">Esqueceu sua senha?</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



