<template>
    <div class="app table-responsive">
        <table class="table table-striped">
                <thead>
                    <tr>
                    <th  scope="col">#</th>
                    <th scope="col">Code</th>
                    <th scope="col">Serial Number</th>
                    <th scope="col">Categories</th>
                    <th scope="col">Sub Categories</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="code in codes" :key="code.id">
                        <th scope="row">{{code.id}}</th>
                        <td>{{code.code}}</td>
                        <td>{{code.serial}}</td>
                        <td>{{code.categories.title}}</td>
                        <td>{{code.sub_categories.title}}</td>
                        <td>
                            <a :href="'/admin/edit_code/' + code.id" class="btn btn-info btn-sm">
                                <span class="glyphicon glyphicon-pencil"></span>&nbsp;
                                Edit
                            </a>
                            <button @click="remove(code.id)" title="delete" class="btn btn-danger restore" >
                                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Delete</span>
                            </button>
                            <button @click="order(code.id)" title="delete" class="btn btn-success restore" >
                                <i class="voyager-double-right"></i> <span class="hidden-xs hidden-sm">Order</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
    </div>
</template>
<script>
export default {
    props:['codes'],
    created() {
        
    },
    methods:{
        remove(id) {
            confirm('Do you want remove ?') && axios.get('/admin/code/remove/' + id).then(res => {
                location.reload();
            }).catch(err => {console.log(err)});
        },
        order(id) {
            confirm('Do you want order ?') && axios.get('/admin/code/change_state/' + id).then(res => {
                location.reload()
            }).catch(err => {console.log(err)})
        }
    }
}
</script>