@extends('layouts.app')

@section('content')
  <pagina tamanho="10">
     <painel titulo="Dashboard">
     <migalhas :lista="{{$listaMigalhas}}"></migalhas>
                    <div class="row">
                        <div class="col-md-4">
                            <caixa qtd="80" titulo="Artigos" url="{{route('artigos.index')}}" cor="orange" icone="ion ion-stats-bars"></caixa>
                        </div>
                        <div class="col-md-4">
                        <caixa qtd="150" titulo="Usuários" url="#" cor="blue" icone="ion ion-person-stalker"></caixa>
                        </div>
                        <div class="col-md-4">
                        <caixa qtd="3" titulo="Autores" url="#" cor="red" icone="ion ion-person"></caixa>                                                </div>

                    </div>

     </painel>

  </pagina>
@endsection
