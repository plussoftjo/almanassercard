<template>
  <div class="CountCard">
    <div class="alert alert-success" role="alert">
      {{title}}: {{value}}
    </div>
  </div>
</template>
<script>
export default {
    props:['title','value']
};
</script>
<style scoped>
</style>