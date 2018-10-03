@extends('layouts.app')

@section('content')
  <pagina tamanho="12">

  @if($errors->all())
      <div class="alert alert-danger alert-dismissible text-center" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        @foreach ($errors->all() as $key => $value)
          <li><strong>{{$value}}</strong></li>
        @endforeach
      </div>
    @endif


     <painel titulo="Lista de artigos">

       <migalhas :lista="{{$listaMigalhas}}"></migalhas>


        <tabela-lista
           :titulos="['#', 'Titulo', 'Descrição', 'data']"
           :itens="{{json_encode($listaArtigos)}}"
           ordem="asc" ordemcoluna=0
           criar="#criar" detalhe="/admin/artigos/" editar="/admin/artigos/" deletar="/admin/artigos/" token="{{ csrf_token() }}"
           modal="sim">
          
          </tabela-lista>
          <div align="center">
              {{$listaArtigos}}
           </div>
     </painel>

  </pagina>
  <modal nome="adicionar" titulo="Adicionar">
        <formulario id="idFormularioAdicionar" css="" action="{{route('artigos.store')}}" method="post" enctype="" token="{{ csrf_token() }}">
            <div class="form-group">
              <label for="titulo">Titulo</label>
              <input type="text" class="form-control" id="titulo" name="titulo"  placeholder="Titulo" value="{{old('titulo')}}">
            </div>
            <div class="form-group">
              <label for="descricao">Descrição</label>
              <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descricao" value="{{old('descricao')}}">
            </div>
            <div class="form-group">
              <label for="conteudo">Conteudo</label>
              <textarea  class="form-control" name="conteudo" id="conteudo">{{old('conteudo')}}</textarea>
            </div>
            <div class="form-group">
              <label for="data">Data</label>
              <input type="datetime-local" class="form-control" id="data" name="data" value="{{old('data')}}">
            </div>
        </formulario>
        <span slot="botoes">
          <button class="btn btn-info" form="idFormularioAdicionar" >Adicionar</button>
        </span>

  </modal>
  <modal nome="editar" titulo="Editar">
        <formulario id="idFormularioEditar"  :action="'/admin/artigos/' + $store.state.item.id" method="put" enctype="" token="{{ csrf_token() }}">
            <div class="form-group">
              <label for="titulo">Titulo</label>
              <input type="text" class="form-control" id="titulo" v-model="$store.state.item.titulo" name="titulo" placeholder="Titulo">
            </div>
            <div class="form-group">
              <label for="descricao">Descrição</label>
              <input type="text" class="form-control" id="descricao" name="descricao" v-model="$store.state.item.descricao" placeholder="Descricao">
            </div>
            <div class="form-group">
              <label for="conteudo">Conteudo</label>
              <textarea  class="form-control" name="conteudo" id="conteudo" v-model="$store.state.item.conteudo"></textarea>
            </div>
            <div class="form-group">
              <label for="data">Data</label>
              <input type="datetime-local" class="form-control" id="data" name="data" v-model="$store.state.item.data">
            </div>

        </formulario>
        <span slot="botoes">
          <button class="btn btn-info" form="idFormularioEditar" >Editar</button>
        </span>
  </modal>
  <modal nome="detalhe" :titulo="$store.state.item.titulo">
    <p>@{{$store.state.item.descricao}}</p>
    <p>@{{$store.state.item.conteudo}}</p>
  </modal>
@endsection
