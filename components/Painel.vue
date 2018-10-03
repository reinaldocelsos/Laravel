<template>
<div v-bind:class="definerCor">
    <div class="panel-heading">{{titulo}}</div>

    <div class="panel-body">
        <slot></slot>
    </div>
</div>
</template>

<script>
export default {
    props: ["titulo", "cor"],
    computed: {
        definerCor: function () {
            return "panel " + (this.cor || "panel-default");
        }
    }
};
</script>

<style>
  .blue {
      border-color: #0c228e;
  }
  .blue > .panel-heading {
      color: #8aa08a;
      background-color: #0c228e;
      border-color: #0c228e;
  }
</style>
