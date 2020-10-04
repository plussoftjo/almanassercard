<template>
  <div class="app">
    <!-- Add Code -->
    <div class="FormTitle">Order reports</div>

    <div class="FormBody">
      <div class="row">
        <div class="col-md-8">
          <div class="form-group">
            <label for="type">Select type</label>
            <select class="form-control" v-model="type" id="type">
              <option value="today">Today</option>
              <option value="month">This Month</option>
              <option value="all">All</option>
            </select>
          </div>
          </div>
          <div class="col-md-4">
            <label for="search" id="search"></label>
            <button @click="fetch" class="btn btn-info btn-block" id="search">Search</button>
          </div>
      </div>
      <table class="table table-striped">
          <thead>
              <tr>
              <th  scope="col">ID</th>
              <th scope="col">User Number</th>
              <th scope="col">Code id </th>
              <th scope="col">amount</th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="order in orders" :key="order.id">
                  <th scope="row">{{order.id}}</th>
                  <td>{{order.user_id}}</td>
                  <td>{{order.code_id}}</td>
                  <td>{{order.amount}}</td>
              </tr>
              <tr>
                <th scope="row"><span style="font-weight:800;">Total</span></th>
                <th></th>
                <th></th>
                <th>{{total}}</th>
              </tr>
          </tbody>
      </table>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      orders:[],
      type:''
    };
  },
  methods: {
    fetch() {
      const vm = this;
      axios.get('/admin/reports/fetch/' + vm.type).then(res => {
        vm.orders = res.data
      }).catch(err => {
        console.log(err.response)
      })
    }
},
computed:{
  total:function() {
    let vm = this;
    let total = 0;
    vm.orders.forEach((trg) => {
      total = trg.amount +total;
    })
    return total;
  }
},
  created() {
    const vm = this;
    vm.fetch();
  },
};
</script>
<style scoped>
.FormTitle {
  font-weight: 700;
}
.FormBody {
  padding-top: 10px;
}
</style>