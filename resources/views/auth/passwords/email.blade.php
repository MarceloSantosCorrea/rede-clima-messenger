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
                            <p class="text-muted mb-4 mt-3">Digite seu endereço de e-mail e enviaremos um e-mail com instruções para redefinir sua senha.</p>
                        </div>

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="emailaddress">E-mail</label>
                                <input class="form-control" type="email" id="emailaddress" required="" placeholder="Informe seu E-mail">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit"> Enviar Link para reset de senha</button>
                            </div>

                        </form>

                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-white-50">Voltar para
                            <a href="{{ route('login') }}" class="text-white ml-1"><b>Login</b></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
