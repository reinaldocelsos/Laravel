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


     <painel titulo="Lista de usuarios">

       <migalhas :lista="{{$listaMigalhas}}"></migalhas>


        <tabela-lista
           :titulos="['#', 'Nome', 'Email']"
           :itens="{{json_encode($listaModelo)}}"
           ordem="asc" ordemcoluna=0
           criar="#criar" detalhe="/admin/usuarios/" editar="/admin/usuarios/" deletar="/admin/usuarios/" token="{{ csrf_token() }}"
           modal="sim">
          
          </tabela-lista>
          <div align="center">
              {{$listaModelo}}
           </div>
     </painel>

  </pagina>
  <modal nome="adicionar" titulo="Adicionar">
        <formulario id="idFormularioAdicionar" css="" action="{{route('usuarios.store')}}" method="post" enctype="" token="{{ csrf_token() }}">
            <div class="form-group">
              <label for="name">Nome</label>
              <input type="text" class="form-control" id="name" name="name"  placeholder="Nome" value="{{old('name')}}">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{old('email')}}">
            </div>
            <div class="form-group">
              <label for="password">Senha</label>
              <input type="password" class="form-control" id="senha" name="password" value="{{old('password')}}">
            </div>
        </formulario>
        <span slot="botoes">
          <button class="btn btn-info" form="idFormularioAdicionar" >Adicionar</button>
        </span>

  </modal>
  <modal nome="editar" titulo="Editar">
        <formulario id="idFormularioEditar"  :action="'/admin/usuarios/' + $store.state.item.id" method="put" enctype="" token="{{ csrf_token() }}">
            <div class="form-group">
              <label for="name">Nome</label>
              <input type="text" class="form-control" id="name" v-model="$store.state.item.name" name="name" placeholder="Nome">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control" id="email" name="email" v-model="$store.state.item.email" placeholder="email">
            </div>
            <div class="form-group">
              <label for="password">Senha</label>
              <input type="password" class="form-control" id="senha" name="password" >
            </div>

        </formulario>
        <span slot="botoes">
          <button class="btn btn-info" form="idFormularioEditar" >Editar</button>
        </span>
  </modal>
  <modal nome="detalhe" :titulo="$store.state.item.name">
    <p>@{{$store.state.item.email}}</p>
    
  </modal>
@endsection
