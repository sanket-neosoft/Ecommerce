<template>
  <div class="product-image-wrapper">
    <router-link v-bind:to="{ name: 'ProductDetails', params: { id: product.id } }">
      <div class="single-products">
        <div class="productinfo text-center">
          <img alt="" />
          <h2>&#8377;{{ product.price }}</h2>
          <h4 class="text-muted">{{ product.brand }} {{ product.name }}</h4>
        </div>
      </div>
      <div class="choose">
        <ul class="nav nav-pills nav-justified">
          <li>
            <a href="#"><i class="fa fa-star"></i>Add to wishlist</a>
          </li>
          <li>
            <a href="#"><i class="fa fa-shopping-cart"></i>Add to cart</a>
          </li>
        </ul>
      </div>
    </router-link>
  </div>
</template>

<script>
import { MAIN_URL } from "../../common/Url";
export default {
  name: "ProductCard.vue",
  props: ["product"],
  data() {
    return {
      MAIN_URL: MAIN_URL,
    };
  },
};
</script>

<style>
</style>