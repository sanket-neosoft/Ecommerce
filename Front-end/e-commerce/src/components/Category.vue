<template>
  <div class="container">
    <div class="row">
      <SideBar />
      <div class="col-sm-9 padding-right">
        <div class="features_items">
          <!--features_items-->
          <h2 class="title text-center">{{ page_title }}</h2>
          <div
            class="col-sm-4"
            v-for="(product, index) in products"
            v-bind:key="index"
          >
            <ProductCard v-bind:product="product" />
          </div>
        </div>
        <!--features_items-->
      </div>
    </div>
  </div>
  <!-- <div>hello</div> -->
</template>

<script>
import SideBar from "./SideBar.vue";
import ProductCard from "./product-components/ProductCard.vue";
import { categoryProducts } from "../common/Service";
export default {
  name: "Category",
  components: {
    SideBar,
    ProductCard,
  },
  data() {
    return {
      param: null,
      category: null,
      page_title: null,
      products: null,
    };
  },
  mounted() {
    this.param = this.$route.params.id;
    categoryProducts(this.param).then((res) => {
      this.category = res.data.category;
      this.page_title = res.data.category.name;
      this.products = res.data.category.products;
    });
  },
  watch: {
    $route(to) {
      categoryProducts(to.params.id).then((res) => {
        this.category = res.data.category;
        this.page_title = res.data.category.name;
        this.products = res.data.category.products;
      });
    },
  },
};
</script>

<style>
</style>