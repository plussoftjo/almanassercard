<template>
  <div class="app">
    <table class="table table-striped">
                <thead>
                    <tr>
                    <th  scope="col">#</th>
                    <th scope="col">User</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <th scope="row">{{user.id}}</th>
                        <th >{{user.name}}</th>
                        <td>{{user.created_at}}</td>
                        <td>
                            <a :href="'/admin/clients/show/' + user.id" class="btn btn-info btn-sm">
                                <span class="glyphicon glyphicon-pencil"></span>&nbsp;
                                Show
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
    </div>
</template>
<script>
export default {
  props:['users'],
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