<template>
  <div class="app">
    <!-- Add Code -->
    <h3 class="FormTitle">Add Wallet Balance</h3>
    <hr>
    <div class="form-group">
      <label for="user">Select User</label>
      <select class="form-control" id="user" v-model="user_id">
        <option v-for="user in users" :key="user.id" :value="user.id">{{user.id}} - {{user.name}}</option>
      </select>
    </div>
    <div class="form-group">
      <label for="balance">Balance</label>
      <input type="text" class="form-control" placeholder="set balance" @keypress="isNumber($event)" v-model="balance">
    </div>
    <button @click="store" class="btn btn-success">Add Balance</button>
  </div>
</template>
<script>
export default {
  props:['users'],
  data() {
    return {
      user_id:1,
      balance:null
    }
  },
  created() {
  },
  methods:{
    store() {
      let vm = this;
      axios.post('/admin/add_balance/store',{
        user_id:vm.user_id,
        wallet:vm.balance
      }).then(res => {
        alert('Wallet updated')
        location.reload()
      }).catch(err => {console.log(err)})
    },
    isNumber: function(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
        evt.preventDefault();;
      } else {
        return true;
      }
    }
  }
};
</script>
<style scoped>

</style>