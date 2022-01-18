<template>
  <div class="product-image-wrapper">
    <div class="single-products">
      <router-link
        v-bind:to="{ name: 'ProductDetails', params: { id: product.id } }"
      >
        <div class="productinfo text-center">
          <img v-bind:src="MAIN_URL + product.thumbnail" alt="" />
          <h2>{{ product.price |rupee }}</h2>
          <h4 class="text-muted">{{ product.brand }} {{ product.name }}</h4>
        </div>
      </router-link>
    </div>
    <div class="choose">
      <ul class="nav nav-pills nav-justified">
        <li v-if="user !== null">
          <a href="javascript:void(0)" v-on:click="addInWishList(product.id)"
            ><i class="fa fa-star"></i>Add to wishlist</a
          >
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
import { addToCart, addToWishList, productDetails } from "../../common/Service";
import toastr from "toastr";
import { mapState } from 'vuex';
import {rupee} from '../../common/Filter'
export default {
  name: "ProductCard.vue",
  props: ["product"],
  data() {
    return {
      MAIN_URL: MAIN_URL,
      data: {
        user_id: null,
        product_name: null,
        product_id: null,
        product_image: null,
        product_price: null,
        product_brand: null,
      },
    };
  },
  filters :{
    rupee
  },
  computed: {
    ...mapState(['user']),
  },
  methods: {
    addInCart(id) {
      addToCart(id);
    },
    addInWishList(id) {
      productDetails(id).then((res) => {
        this.data.user_id = this.$store.getters.user.user_id;
        this.data.product_id = res.data.product.id;
        this.data.product_name = res.data.product.name;
        this.data.product_image = res.data.product.thumbnail;
        this.data.product_price = res.data.product.price;
        this.data.product_brand = res.data.product.brand;
        let wishlist = [];
        wishlist = JSON.parse(localStorage.getItem("wishlist"));
        if (wishlist.includes(id)) {
          toastr.error("Product already added to wishlist");
        } else {
          wishlist.push(id);
          localStorage.setItem("wishlist", JSON.stringify(wishlist));
          addToWishList(this.data).then((res) => {
            toastr.success(`${this.data.product_name} ${res.data.message}`);
          });
        }
        this.$store.dispatch("addToWishlist", wishlist);
      });
    },
  },
};
</script>

<style scoped>

</style>