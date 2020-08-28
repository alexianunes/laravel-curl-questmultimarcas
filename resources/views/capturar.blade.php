@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Capturar Carros</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                    
                <form action="{{route('capturar.store')}}" method="POST"> 
                @csrf
                
                <div class="row">
                    <div class="col-md-11 ml-3">
                        <input type="text" name="txtCapturar" required class="form-control" placeholder="Digite o termo de pesquisa" />
                    </div>
                </div>

                <div class="row mt-3 mb-3">
                    <div class="col-md-3 offset-md-9">
                        <a href="{{ route('capturar') }}">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </a>
                    </div>
                </div>

                </form>
                


            </div>
        </div>
    </div>
</div>
@endsection
