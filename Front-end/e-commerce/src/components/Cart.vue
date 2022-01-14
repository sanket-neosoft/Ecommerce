<template>
  <div>
    <section id="cart_items">
      <div class="container">
        <div class="breadcrumbs">
          <ol class="breadcrumb">
            <li><router-link to="/">Home</router-link></li>
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
                <td class="quantity">Quantity</td>
                <td class="total">Total</td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <tr v-if="!cart || cart.length === 0">
                <td colspan="6" style="text-align: center">
                  <h4>Your Cart is Empty</h4>
                </td>
              </tr>
              <tr v-for="(product, index) in cart" v-bind:key="index">
                <td class="cart_product">
                  <router-link
                    v-bind:to="{
                      name: 'ProductDetails',
                      params: { id: product.id },
                    }"
                    ><img
                      class="cart_img"
                      v-bind:src="MAIN_URL + product.thumbnail"
                      alt=""
                  /></router-link>
                </td>
                <td class="cart_description">
                  <h4>
                    <router-link to="">{{ product.name }} </router-link>
                  </h4>
                  <p>{{ product.brand }}</p>
                </td>
                <td class="cart_price">
                  <!-- <p v-if="product.sale_price !== null">
                    {{ product.sale_price }}
                  </p> -->
                  <p>{{ product.price }}</p>
                </td>
                <td class="cart_quantity">
                  <div class="cart_quantity_button">
                    <a
                      class="cart_quantity_up"
                      v-on:click="increment(product.id)"
                      href="javascript:void(0)"
                    >
                      +
                    </a>
                    <input
                      class="cart_quantity_input"
                      type="text"
                      name="quantity"
                      v-bind:value="products[index].quantity"
                      autocomplete="off"
                      size="2"
                    />
                    <a
                      class="cart_quantity_down"
                      v-on:click="decrement(product.id)"
                      href="javascript:void(0)"
                    >
                      -
                    </a>
                  </div>
                </td>
                <td class="cart_total">
                  <p class="cart_total_price">
                    {{ products[index].quantity * product.price }}
                  </p>
                </td>
                <td class="cart_delete">
                  <a
                    class="cart_quantity_delete"
                    href="javascript:void(0)"
                    v-on:click="deleteFromCart(product.id)"
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

    <section id="do_action" v-if="cart.length !== 0">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 pull-right">
            <div class="total_area">
              <ul>
                <li>
                  Cart Sub Total <span>{{ subTotal }}</span>
                </li>
                <li>
                  Shipping Cost
                  <span v-if="subTotal < 500">{{ shipping_cost }}</span
                  ><span v-else>Free</span>
                </li>
                <li>
                  Total
                  <span v-if="subTotal < 500">{{
                    subTotal + shipping_cost
                  }}</span
                  ><span v-else>{{ subTotal }}</span>
                </li>
              </ul>
              <!-- <a class="btn btn-default update" href="">Update</a> -->
              <router-link class="btn btn-default update" to="/checkout"
                >Check Out</router-link
              >
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!--/#do_action-->
</template>

<script>
import { productDetails } from "../common/Service";
import { MAIN_URL } from "../common/Url";
// import { productDetails } from "../common/Service";
export default {
  name: "Cart",
  data() {
    return {
      cart: [],
      MAIN_URL: MAIN_URL,
      shipping_cost: 50,
    };
  },
  computed: {
    subTotal: function () {
      let sum = 0;
      for (let index in this.cart) {
        sum += this.products[index].quantity * this.cart[index].price;
      }
      return sum;
    },
  },
  mounted() {
    this.products = this.$store.getters.cart;
    this.products.map((value) => {
      productDetails(value.id).then((res) => {
        this.cart.push(res.data.product);
      });
    });
  },
  methods: {
    deleteFromCart(id) {
      this.products = this.products.filter((value) => value.id != id);
      localStorage.setItem("cart", JSON.stringify(this.products));
      this.cart = this.cart.filter((value) => value.id != id);
      this.$store.dispatch("addToCart", this.products);
      console.log(this.products);
    },
    increment(id) {
      this.products.find((product) => product.id === id).quantity += 1;
      localStorage.setItem("cart", JSON.stringify(this.products));
      this.$store.dispatch("addToCart", this.products);
    },
    decrement(id) {
      let count = this.products.find((product) => product.id === id).quantity;
      if (count > 1) {
        this.products.find((product) => product.id === id).quantity -= 1;
        localStorage.setItem("cart", JSON.stringify(this.products));
        this.$store.dispatch("addToCart", this.products);
      }
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