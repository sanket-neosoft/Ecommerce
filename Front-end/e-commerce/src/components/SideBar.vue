<template>
  <div class="col-sm-3">
    <div class="left-sidebar">
      <h2>Category</h2>
      <div class="panel-group category-products" id="accordian">
        <!--category-productsr-->
        <div
          class="panel panel-default"
          v-for="(category, index) in categories"
          v-bind:key="index"
        >
          <div class="panel-heading">
            <h4 class="panel-title">
              <router-link
                v-bind:to="{ name: 'Category', params: { id: category.id } }"
              >
                <span class="pull-right">({{ category.products.length }})</span
                >{{ category.name }}</router-link
              >
            </h4>
          </div>
        </div>
      </div>
      <!--/category-products-->

      <div class="shipping text-center">
        <!--shipping-->
        <img v-bind:src="`${publicPath}images/home/shipping.jpg`" alt="" />
      </div>
      <!--/shipping-->
    </div>
  </div>
</template>

<script>
import { categories } from "../common/Service";
// import router from "../router";
export default {
  name: "SideBar",
  data() {
    return {
      categories: undefined,
      publicPath: process.env.BASE_URL,
    };
  },
  mounted() {
    categories().then((res) => {
      this.categories = res.data.categories;
    });
  },
};
</script>

<style>
</style>