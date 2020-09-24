<template>
  <div class="app">
    <!-- Add Code -->
    <div class="FormTitle">Edit Code</div>

    <div class="FormBody">
      <!-- Code -->
      <div class="form-group">
        <label for="code">Code</label>
        <input type="text" id="code" class="form-control" placeholder="Code" v-model="data.code" />
      </div>
      <!-- Categories -->
      <div class="form-group">
        <label for="Categories">Category</label>
        <select
          class="form-control"
          id="Categories"
          v-model="data.category"
          @change="change_categories"
        >
          <option v-for="catg in categories" :key="catg.id" :value="catg.id">{{catg.title}}</option>
        </select>
      </div>
      <!-- Sub Categories -->
      <div class="form-group" v-if="sub_categories.length >= 1">
        <label for="SubCategories">Sub Categories</label>
        <select
          class="form-control"
          id="SubCategories"
          @change="change_sub_categories"
          v-model="data.sub_category"
        >
          <option
            v-for="SubCatg in sub_categories"
            :key="SubCatg.id"
            :value="SubCatg.id"
          >{{SubCatg.title}}</option>
        </select>
      </div>
      <!-- Sub Categories -->
      <div class="form-group" v-if="last_categories.length >= 1">
        <label for="SubCategories">Sub Categories</label>
        <select class="form-control" id="SubCategories" v-model="data.last_category">
          <option
            v-for="LastCatg in last_categories"
            :key="LastCatg.id"
            :value="LastCatg.id"
          >{{LastCatg.title}}</option>
        </select>
      </div>
    </div>
    <div class="alert alert-danger" v-if="error" role="alert">There Are Error</div>
    <button class="btn btn-info" @click="save">Save</button>
    <button class="btn btn-danger" @click="remove">Remove</button>
  </div>
</template>
<script>
export default {
  props: ["code"],
  data() {
    return {
      categories: [],
      sub_categories: [],
      last_categories: [],
      data: {
        code: "",
        category: "",
        sub_category: "",
        last_category: "",
        has_last_category: false,
      },
      error: false,
    };
  },
  methods: {
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
    save() {
      let vm = this;
      vm.error = false;
      if (vm.data.code == "") {
        vm.error = true;
        return;
      }
      if (vm.data.category == "") {
        vm.error = true;
        return;
      }
      if (vm.data.sub_category == "") {
        vm.error = true;
        return;
      }

      if (vm.data.has_last_category == true) {
        if (vm.data.last_category == "") {
          vm.error = true;
          return;
        }
      }

      // Axios Fetch Save
      axios
        .post("/admin/edit_code/update/" + vm.code.id, vm.data)
        .then((res) => {
          alert("Edit Success");
        })
        .catch((err) => {
          console.log(err.response);
          vm.error = true;
        });
    },
    change_categories() {
      const vm = this;
      axios
        .get("/helper/sub_categories/with_category_id/" + vm.data.category)
        .then((res) => {
          vm.sub_categories = res.data;
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
    remove() {
      const vm = this;
      confirm("Do you want remove ?") &&
        axios
          .get("/admin/code/remove/" + vm.code.id)
          .then((res) => {
            window.location.href = "/admin/code";
          })
          .catch((err) => {
            console.log(err);
          });
    },
    change_sub_categories() {
      const vm = this;
      vm.sub_categories.forEach((trg, index) => {
        // Check if the model id same the trg id
        if (trg.id == vm.data.sub_category) {
          if (trg.multi == 1) {
            vm.data.has_last_category = true;
            axios
              .get(
                "/helper/last_categories/with_category_id/" +
                  vm.data.sub_category
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
  created() {
    const vm = this;
    console.log(vm.code);
    vm.categoriesIndex();
    vm.data = {
      code: vm.code.code,
      category: vm.code.categories_id,
      sub_category: vm.code.sub_categories_id,
    };

    vm.change_categories();
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