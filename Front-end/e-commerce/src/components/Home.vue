<template>
  <div>
    <Carousel />
    <div class="container">
      <div class="row">
        <SideBar />
        <div class="col-sm-9 padding-right">
          <div class="features_items">
            <!--features_items-->
            <h2 class="title text-center">Featured Items</h2>
            <div
              class="col-sm-4"
              v-for="(featured_product, index) in featured_products"
              v-bind:key="index"
            >
              <ProductCard v-bind:product="featured_product" />
            </div>
          </div>
          <!--features_items-->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Carousel from "./Carousel.vue";
import ProductCard from "./product-components/ProductCard.vue";
import SideBar from "./SideBar.vue";
import { products } from "../common/Service";
import { MAIN_URL } from "../common/Url";
export default {
  name: "Home",
  components: {
    Carousel,
    ProductCard,
    SideBar,
  },
  data() {
    return {
      featured_products: undefined,
      MAIN_URL: MAIN_URL,
    };
  },
  mounted() {
    products().then((res) => {
      this.featured_products = res.data.products.filter(
        (product) => product.featured === 1
      );
    });
  },
};
</script>