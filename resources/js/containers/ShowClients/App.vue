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

    <!-- Order Info -->
    <div style="padding:20px;border:1px solid black;border-radius:3px;">
      <h3>Wallet Logs</h3>
        <div style="border-bottom:1px solid black;" v-for="log in wallet_logs" :key="log.id">
          <h5>
            ID: {{log.id}}
          </h5>
          <h5>
            Added Amount{{log.amount}}
          </h5>
          <h5>
            Last Wallet Balance: {{log.old_amount}}
          </h5>
        </div>
    </div>
    </div>
</template>
<script>
export default {
  props:['user','wallet','order_count','spent','wallet_logs'],
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