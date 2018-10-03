<template>
    <div>
         
          <div class="form-inline">
            
            <a v-if="criar && !modal" :href="criar">Criar</a>
             <modallink v-if="criar && modal" tipo='button' nome="adicionar" titulo="Criar" css=''></modallink>  
            <div class="form-group pull-right">
                <input type="search" placeholder="Buscar" class="form-control" v-model="buscar">
            </div>
          </div>



        <table class="table table-striped table-hover">
          <thead>
            <tr >
              <th style="cursor:pointer;" @click="ordenaColuna(index)" v-for="(titulo, index) in titulos" v-bind:key="index">{{titulo}}</th>
              <th v-if="detalhe || editar || deletar">Ação</th>
            </tr>
          </thead>
          <tbody>
            
            <tr v-for="(item, index) in lista" v-bind:key="index">
              <td v-for="i in item" v-bind:key="i">{{i}}</td>   

              <td v-if="detalhe || editar || deletar">
                  <form :id="index" v-if="deletar && token" :action="deletar  + item.id" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" :value="token">
                    
                    <a v-if="detalhe && !modal" :href="detalhe"> Detalhe |</a>
                     <modallink v-if="detalhe && modal" tipo='link' nome="detalhe" :item="item" :url="detalhe" titulo="Detalhe |" css=''></modallink>  
                    
                    <a  v-if="editar && !modal" :href="editar"> Editar |</a>
                     <modallink v-if="editar && modal" tipo='link' nome="editar" :item="item" :url="editar" titulo="Editar |" css=''></modallink>  
                    <a href="#" @click="executaForm(index)">Deletar</a>
                  </form>
                <span v-if="!token">
                    <a v-if="detalhe && !modal" :href="detalhe"> Detalhe |</a>
                     <modallink v-if="detalhe && modal" tipo='link' nome="detalhe" :item="item" :url="detalhe" titulo="Detalhe |" css=''></modallink>  
   
                   <a  v-if="editar && !modal" :href="editar"> Editar |</a>
                   <modallink v-if="editar && modal" tipo='link' :item="item" nome="editar" :url="editar" titulo="Editar |" css=''></modallink>  
                    <a v-if="deletar" :href="deletar">Deletar</a>
                </span>
                 <span v-if="token && !deletar">
                    <a v-if="detalhe && !modal" :href="detalhe"> Detalhe |</a>
                    <modallink v-if="detalhe && modal" tipo='link' nome="detalhe" :item="item" :url="detalhe" titulo="Detalhe |" css=''></modallink>  
   
                    <a  v-if="editar && !modal" :href="editar"> Editar |</a>
                     <modallink v-if="editar && modal" tipo='link' :item="item" nome="editar" :url="editar"  titulo="Editar |" css=''></modallink>                   
                </span>
              </td>
            </tr>
          </tbody>
        </table>
    </div>
</template>

<script>
export default {
  props: [
    "titulos",
    "itens",
    "criar",
    "ordem",
    "ordemcoluna",
    "detalhe",
    "editar",
    "deletar",
    "token",
    "modal"
  ],
  data: function() {
    return {
      buscar: "",
      ordemAux: this.ordem || "asc",
      ordemAuxCol: this.ordemcoluna || 0
    };
  },
  methods: {
    executaForm: function(index) {
      document.getElementById(index).submit();
    },
    ordenaColuna: function(coluna) {
      this.ordemAuxCol = coluna;
      if (this.ordemAux.toLowerCase() == "asc") {
        this.ordemAux = "desc";
      } else {
        this.ordemAux = "asc";
      }
    }
  },
  computed: {
    lista: function() {
      
      let lista = this.itens.data;
      console.log(lista);
      
      let ordem = this.ordemAux;
      let ordemcoluna = this.ordemAuxCol;

      ordem = ordem.toLowerCase();
      ordemcoluna = parseInt(ordemcoluna);
      if (ordem == "asc") {
        lista.sort(function(a, b) {
          if (Object.values(a)[ordemcoluna] > Object.values(b)[ordemcoluna]) {
            return 1;
          }
          if (Object.values(a)[ordemcoluna] < Object.values(b)[ordemcoluna]) {
            return -1;
          }
          return 0;
        });
      } else {
        lista.sort(function(a, b) {
          if (Object.values(a)[ordemcoluna] < Object.values(b)[ordemcoluna]) {
            return 1;
          }
          if (Object.values(a)[ordemcoluna] >  Object.values(b)[ordemcoluna]) {
            return -1;
          }
          return 0;
        });
      }

      if (this.buscar) {
        return lista.filter(res => {
          res = Object.values(res);
          for (let k = 0; k < res.length; k++) {
            if (
              (res[k] + "").toLowerCase().indexOf(this.buscar.toLowerCase()) >= 0
            ) {
              return true;
            }
          }
          return false;
        });
      }
      return lista;
    }
  }
};
</script>

<style>
</style>
