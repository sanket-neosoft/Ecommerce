<template>
  <div class="product-image-wrapper">
    <div class="single-products">
      <router-link
        v-bind:to="{ name: 'ProductDetails', params: { id: product.id } }"
      >
        <div class="productinfo text-center">
          <img v-bind:src="MAIN_URL + product.thumbnail" alt="" />
          <h2>&#8377;{{ product.price }}</h2>
          <h4 class="text-muted">{{ product.brand }} {{ product.name }}</h4>
        </div>
      </router-link>
    </div>
    <div class="choose">
      <ul class="nav nav-pills nav-justified">
        <li>
          <a href="#"><i class="fa fa-star"></i>Add to wishlist</a>
        </li>
        <li>
          <a href="javascript:void(0)" v-on:click="addInCart(product.id)"
            ><i class="fa fa-shopping-cart"></i>Add to cart</a
          >
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { MAIN_URL } from "../../common/Url";
import { addToCart } from "../../common/Service";
export default {
  name: "ProductCard.vue",
  props: ["product"],
  data() {
    return {
      MAIN_URL: MAIN_URL,
    };
  },
  methods: {
    addInCart(id) {
      addToCart(id);
    },
  },
};
</script>

<style>
</style>