<template>
  <div class="app">
    
    <!-- Client Info -->
    <div style="padding:20px;border:1px solid black;border-radius:3px;">
         <div class="form-group">
          <label for="code">Code</label>
          <input type="text" id="code" class="form-control" placeholder="Serial Number" v-model="code" />
        </div>
      <button class="btn btn-info" @click="search">Search</button>
    </div>
   

    <div v-if="type_ == 1 || type_ == 2" style="margin-top:20px;padding:20px;border:1px solid black;border-radius:3px;">
      <h3>Code Details</h3>
      <h5>Code: {{code_.code}}</h5>
      <h5>Categories: {{code_.categories.title}} - {{code_.sub_categories.title}} {{code_.sub_categories.SubTitle}}</h5>
      <h5>Active: {{code_.active == 0 ?'Active':"Used"}}</h5>
      <h5>Created At: {{code_.created_at}}</h5>
    </div>
    <div v-if="type_ == 2" style="margin-top:20px;padding:20px;border:1px solid black;border-radius:3px;">
      <h3>Order Details</h3>
      <h5>Order ID: {{order_.id}}</h5>
      <h5>Amount: {{order_.amount}}JOD</h5>
      <h5>Created At: {{order_.created_at}}</h5>
    </div>
    <div v-if="type_ == 2" style="margin-top:20px;padding:20px;border:1px solid black;border-radius:3px;">
      <h3>User Details</h3>
      <h5>User ID: {{user_.id}}</h5>
      <h5>Name: {{user_.name}}</h5>
      <h5>User Created At: {{user_.created_at}}</h5>
    </div>

    </div>
</template>
<script>
export default {
  props:[],
  data() {
    return {
      code:'',
      code_:{},
      order_:{},
      user_:{},
      type_:0
    };
  },
  methods: {
     search() {
       let vm = this;
       axios.post('/admin/check/code',{code:vm.code}).then(res => {
         let data = res.data;
         if(data.type == 0) {
           vm.type_ =0;
           alert("There Are No Code With This Input");
         } else if(data.type == 1) {
           vm.code_ = data.code
           vm.type_ = 1;
         } else if(data.type == 2) {
           vm.code_ = data.code;
           vm.order_ = data.order;
           vm.user_ = data.user;
           vm.type_ = 2;

         }
       }).catch(err => {
         console.log(err);
       })
     }
  },
  created() {
    const vm = this;
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