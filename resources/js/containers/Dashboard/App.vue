<template>
  <div class="app">
    <h1>Dashboard</h1>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <CountCard :title="'Categories'" :value="categories_count"/>
        </div>
        <div class="col-md-4">
          <CountCard :title="'Codes'" :value="code_count"/>
        </div>
        <div class="col-md-4">
          <CountCard :title="'Orders'" :value="order_count"/>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import CountCard from './components/CountCard'
export default {
  created() {},
  methods: {},
  components:{
    CountCard
  },
  props:[
    'categories_count',
    'code_count',
    'order_count'
  ]
};
</script>