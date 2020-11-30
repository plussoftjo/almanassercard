<template>
  <div class="app">
    
    <!-- Client Info -->
    <div style="padding:20px;border:1px solid black;border-radius:3px;">
        <div>
          <h5>
            User Name: {{user.name}}
          </h5>
          <h5>
            User Created At: {{user.created_at}}
          </h5>
          <h5>
            wallet: {{wallet.amount}}
          </h5>
          <h5>
            Order Done: {{order_count}}
          </h5>
          <h5>
            Money Spent: {{spent}}JOD
          </h5>
        </div>
    </div>


    </div>
</template>
<script>
export default {
  props:['user','wallet','order_count','spent'],
  data() {
    return {
      
    };
  },
  methods: {
     
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