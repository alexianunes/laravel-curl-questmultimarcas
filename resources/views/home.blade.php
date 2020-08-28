@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                    
                <div class="row">
                    <div class="col-md-4 offset-md-8">
                        <a href="{{ route('capturar') }}">
                            <button type="button" class="btn btn-primary">Caputrar Carros</button>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center mt-4 mb-4">Listagem de Artigos</h3>
                    </div>
                </div>

                @if(count($artigos) > 0)
                    @foreach ($artigos as $artigo)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                            <img width="827" height="593" src="{{$artigo->img}}" style="border-radius: 20px;" class="img-fluid">
                            </div>
                            <div class="col-9">
                                <h3>{{$artigo->nome_veiculo}}</h3>
                                <ul style="list-style: none;">
                                    @foreach ($artigo as $key => $detalhe)
                                        <li class="list-artigos"><span style="font-weight: bold;color: #222;">{{$key.':'}}</span> <span>{{$detalhe}}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 offset-md-8">
                            <p>Preço <span style="    color: #01b4b3;">{{'R$ '.$artigo['preco']}}</span></p>
                            </div>
                        </div>
                        <hr>
                    </div>
                    @endforeach
                    
                @else 
                    <p class="text-center">Nenhum Artigo Encontrado.</p>    
                @endif
                


            </div>
        </div>
    </div>
</div>
@endsection
