<template>
  <div>
    <section id="cart_items">
      <div class="container">
        <div class="breadcrumbs">
          <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Shopping Cart</li>
          </ol>
        </div>
        <div class="table-responsive cart_info">
          <table class="table table-condensed">
            <thead>
              <tr class="cart_menu">
                <td class="image">Item</td>
                <td class="description"></td>
                <td class="price">Price</td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <tr v-if="!wishlist || wishlist.length === 0">
                <td colspan="6" style="text-align: center">
                  <h4>Your Wishlist is Empty</h4>
                </td>
              </tr>
              <tr v-for="(product, index) in wishlist" v-bind:key="index">
                <!-- <td>hello</td> -->
                <td class="cart_product">
                  <router-link
                    v-bind:to="{
                      name: 'ProductDetails',
                      params: { id: product.product_id },
                    }"
                    ><img
                      class="cart_img"
                      v-bind:src="MAIN_URL + product.product_image"
                      alt=""
                  /></router-link>
                </td>
                <td class="cart_description">
                  <h4>
                    <router-link to="">{{ product.product_name }} </router-link>
                  </h4>
                </td>
                <td class="cart_price">
                  <p>{{ product.product_price }}</p>
                </td>
                <td class="cart_delete">
                  <a
                    class="cart_quantity_delete"
                    href="javascript:void(0)"
                    v-on:click="
                      deleteFromWishlist(product.id, product.product_id)
                    "
                    ><i class="fa fa-times"></i
                  ></a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <!--/#cart_items-->
  </div>
  <!--/#do_action-->
</template>

<script>
import { userWishlist, deleteFromWishlist } from "../common/Service";
import MAIN_URL from "../common/Url";
export default {
  name: "Wishlist",
  data() {
    return {
      wishlist: null,
      MAIN_URL: MAIN_URL,
    };
  },
  mounted() {
    userWishlist(this.$store.getters.user.user_id).then((res) => {
      this.wishlist = res.data.product;
      console.log(this.wishlist);
    });
  },
  methods: {
    deleteFromWishlist(id, product_id) {
      this.wishlist = this.wishlist.filter(
        (value) => value.product_id != product_id
      );
      let store_wishlist = this.$store.getters.wishlist.filter(
        (value) => value != product_id
      );
      localStorage.setItem("wishlist", store_wishlist);
      this.$store.dispatch("addToWishlist", store_wishlist);
      deleteFromWishlist(id);
      console.log(id);
    },
  },
};
</script>

<style scoped>
.cart_img {
  height: 10rem;
  width: auto;
  object-fit: cover;
  object-position: center;
}
</style>