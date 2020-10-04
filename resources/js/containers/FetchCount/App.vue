<template>
  <div class="app table-responsive">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="type">Select Category</label>
          <select class="form-control" v-model="data.categories_id" id="type" @change="change_categories">
            <option  v-for="category in categories" :key="category.id" :value="category.id" >{{category.title}}</option>
          </select>
        </div>
      </div>
      <div class="col-md-6" v-if="sub_categories.length >= 1">
        <div class="form-group">
          <label for="type">Select Sub Categories</label>
          <select @change="change_sub_categories"
          v-model="data.sub_categories_id" class="form-control" id="type">
            <option v-for="SubCatg in sub_categories"
            :key="SubCatg.id"
            :value="SubCatg.id">{{SubCatg.title}}</option>
          </select>
        </div>
      </div>
      <div class="col-md-6" v-if="last_categories.length >= 1">
        <div class="form-group">
          <label for="type">Select Last Categories</label>
          <select 
          v-model="data.last_categories_id" class="form-control" id="type">
            <option v-for="LastCatg in last_categories"
            :key="LastCatg.id"
            :value="LastCatg.id">{{LastCatg.title}}</option>
          </select>
        </div>
    </div>
    <div class="col-md-6">
        <label for="search" id="search"></label>
            <button @click="fetch" class="btn btn-info btn-block" id="search">
            Search
            </button>
        </div>
    </div>
   
      
    
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Code</th>
          <th scope="col">Categories</th>
          <th scope="col">Sub Categories</th>
          <th scope="col">Active</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="code in codes" :key="code.id">
          <th scope="row">{{ code.id }}</th>
          <td>{{ code.code }}</td>
          <td>{{ code.categories.title }}</td>
          <td>{{ code.sub_categories.title }}</td>
          <td>
            <span v-if="code.active == 0" style="color: green; font-weight: 700"
              >Active</span
            >
            <span v-if="code.active == 1" style="color: red; font-weight: 700"
              >Used</span
            >
          </td>
          <td>
            <a
              :href="'/admin/edit_code/' + code.id"
              class="btn btn-info btn-sm"
            >
              <span class="glyphicon glyphicon-pencil"></span>&nbsp; Edit
            </a>
            <button
              @click="remove(code.id)"
              title="delete"
              class="btn btn-danger restore"
            >
              <i class="voyager-trash"></i>
              <span class="hidden-xs hidden-sm">Delete</span>
            </button>
          </td>
        </tr>
        <tr>
            <th scope="row"><span style="font-weight:800;">Codes Count</span></th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><span style="text-align:center;font-weight:800;">{{codes.length}}</span></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  data() {
    return {
      codes: [],
      data: {
        categories_id: 0,
        sub_categories_id: 0,
        last_categories_id: 0,
        has_last_category: false,
      },
     categories: [],
      sub_categories: [],
      last_categories: [],
    };
  },
  created() {
      let vm = this;
      vm.categoriesIndex()
  },
  methods: {
    remove(id) {
      confirm("Do you want remove ?") &&
        axios
          .get("/admin/code/remove/" + id)
          .then((res) => {
            location.reload();
          })
          .catch((err) => {
            console.log(err);
          });
    },
    fetch() {
      let vm = this;
      axios
        .post("/admin/fetch_count/fetch",vm.data)
        .then((res) => {
          vm.codes = res.data;
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    categoriesIndex() {
      // Get Categories
      const vm = this;
      axios
        .get("/helper/categories/index")
        .then((res) => {
          vm.categories = res.data;
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    change_categories() {
      const vm = this;
      vm.last_categories = [];
      vm.sub_categories = [];
      vm.has_last_category = false;
      axios
        .get("/helper/sub_categories/with_category_id/" + vm.data.categories_id)
        .then((res) => {
          vm.sub_categories = res.data;
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    change_sub_categories() {
      const vm = this;
      vm.sub_categories.forEach((trg, index) => {
        // Check if the model id same the trg id
        if (trg.id == vm.data.sub_categories_id) {
          if (trg.multi == 1) {
            vm.data.has_last_category = true;
            axios
              .get(
                "/helper/last_categories/with_category_id/" +
                  vm.data.sub_categories_id
              )
              .then((res) => {
                vm.last_categories = res.data;
              })
              .catch((err) => {
                console.log(err.response);
              });
          } else {
            vm.has_last_category = false;
          }
        }
      });
    },
  },
};
</script>