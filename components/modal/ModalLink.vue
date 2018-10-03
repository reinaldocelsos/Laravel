<template>
<span>
    
    <span v-if="item">
        <button @click="preencheFormulario()" v-if="tipo=='button'" type="button" :class="css || 'btn btn-primary'"
            data-toggle="modal" :data-target="'#'+ nome">{{titulo}}</button>
        
        <button @click="preencheFormulario()" v-if="!tipo || (tipo !='button' && tipo != 'link')" type="button" :class="css || 'btn btn-primary'"
            data-toggle="modal" :data-target="'#'+ nome">{{titulo}}</button>

        <a @click="preencheFormulario()" v-if="tipo=='link'" href="#" data-toggle="modal" :data-target= "'#' + nome"  :class="css || ''">{{titulo}}</a>

    </span>
     <span v-if="!item">
        <button  v-if="tipo=='button'" type="button" :class="css || 'btn btn-primary'"
            data-toggle="modal" :data-target="'#'+ nome">{{titulo}}</button>
        
        <button  v-if="!tipo || (tipo !='button' && tipo != 'link')" type="button" :class="css || 'btn btn-primary'"
            data-toggle="modal" :data-target="'#'+ nome">{{titulo}}</button>

        <a  v-if="tipo=='link'" href="#" data-toggle="modal" :data-target= "'#' + nome"  :class="css || ''">{{titulo}}</a>
        
    </span>
</span>
</template>
<style>
</style>
<script>
export default {
  props: ["tipo", "nome", "titulo", "css", "item", "url"],
  methods:{
      preencheFormulario: function(){
          axios.get(this.url + this.item.id).then(res =>{
              console.log(res.data);
              
              this.$store.commit('setItem', res.data);
          })
          
      }
  }
};
</script>

