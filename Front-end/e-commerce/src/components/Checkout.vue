<template>
  <section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li class="active">Check out</li>
        </ol>
      </div>
      <!--/breadcrums-->
      <div class="shopper-informations">
        <div class="row">
          <div class="col-sm-4">
            <div class="shopper-info">
              <p>Your Details</p>
              <form>
                <input
                  type="text"
                  placeholder="First Name"
                  v-model="checkout.fname"
                />
                <input
                  type="text"
                  placeholder="Last Name"
                  v-model="checkout.lname"
                />
                <input
                  type="text"
                  placeholder="Email"
                  v-model="checkout.email"
                />
                <input
                  type="tel"
                  placeholder="Contact Number"
                  v-model="checkout.contact"
                />
              </form>
            </div>
          </div>
          <div class="col-sm-8 clearfix">
            <div class="bill-to">
              <p>Address</p>
              <div class="form-one">
                <form>
                  <input
                    type="text"
                    placeholder="Address 1 *"
                    v-model="checkout.addres1"
                  />
                  <input
                    type="text"
                    placeholder="Address 2"
                    v-model="checkout.address2"
                  />
                  <input
                    type="text"
                    placeholder="City *"
                    v-model="checkout.city"
                  />
                  <input
                    type="text"
                    placeholder="District *"
                    v-model="checkout.district"
                  />
                </form>
              </div>
              <div class="form-two">
                <form>
                  <input
                    type="text"
                    placeholder="State *"
                    v-model="checkout.state"
                  />
                  <input
                    type="text"
                    placeholder="Zip / Postal Code *"
                    v-model="checkout.zipcode"
                  />
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="review-payment">
        <h2>Review & Payment</h2>
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
                    autocomplete="off"
                    v-bind:value="products[index].quantity"
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
            <tr>
              <td colspan="4">
                <div class="payment shopper-info">
                  <h4>Payment Method</h4>
                  <button
                    class="btn btn-default update"
                    v-on:click="paymentOffline"
                  >
                    Cash on delivery
                  </button>
                  <button
                    class="btn btn-default check_out"
                    v-on:click="paymentOnline"
                  >
                    PayPal
                  </button>
                  <form>
                    <div class="cash" v-if="online">
                      <h4>Card Details</h4>
                      <div class="form-group">
                        <div class="form-group">
                          <input
                            type="text"
                            placeholder="Card Holder"
                            v-model="checkout.card_holder"
                          />
                        </div>
                        <div class="form-group">
                          <input
                            type="text"
                            placeholder="Card Number"
                            v-model="checkout.card_number"
                          />
                        </div>
                        <div class="form-group">
                          <input
                            type="month"
                            placeholder="Expiry Date"
                            v-model="checkout.card_expiry"
                          />
                        </div>
                        <div class="form-group">
                          <input
                            type="number"
                            placeholder="CVV"
                            v-model="checkout.card_cvv"
                          />
                        </div>
                      </div>
                    </div>
                    <p class="cash" v-else>
                      Payment method is select as Cash on Delivery
                    </p>
                  </form>
                  <button
                    v-on:click="checkoutform"
                    class="btn btn-default update"
                  >
                    Checkout
                  </button>
                </div>
              </td>
              <td colspan="2">
                <table class="table table-condensed total-result">
                  <tr>
                    <td>Cart Sub Total</td>
                    <td>{{ subTotal }}</td>
                  </tr>
                  <tr class="shipping-cost">
                    <td>Shipping Cost</td>
                    <td v-if="subTotal < 500">{{ shipping_cost }}</td>
                    <td v-else>Free</td>
                  </tr>
                  <tr>
                    <td>Total</td>
                    <td>
                      <span v-if="subTotal < 500">{{
                        subTotal + shipping_cost
                      }}</span
                      ><span v-else>{{ subTotal }}</span>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <!--/#cart_items-->
</template>

<script>
import { productDetails, accountDetails, placeOrder } from "../common/Service";
import { MAIN_URL } from "../common/Url";
// import { mapState } from "vuex";
export default {
  name: "Checkout",
  data() {
    return {
      MAIN_URL: MAIN_URL,
      cart: [],
      products: [],
      shipping_cost: 50,
      online: false,
      checkout: {
        fname: null,
        lname: null,
        email: null,
        contact: null,
        address1: null,
        address2: null,
        city: null,
        district: null,
        state: null,
        zipcode: null,
        card_holder: null,
        card_number: null,
        card_expiry: null,
        card_cvv: null,
        coupon: null,
      },
    };
  },
  mounted() {
    this.products = this.$store.getters.cart;
    this.products.map((value) => {
      productDetails(value.id).then((res) => {
        this.cart.push(res.data.product);
      });
    });
    accountDetails().then((res) => {
      this.checkout.fname = res.data.firstname;
      this.checkout.lname = res.data.lastname;
      this.checkout.email = res.data.email;
      console.log(res.data);
    });
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
  methods: {
    deleteFromCart(id) {
      this.products = this.products.filter((value) => value.id != id);
      localStorage.setItem("cart", JSON.stringify(this.products));
      this.$store.dispatch("addToCart", this.products);
    },
    increment(id) {
      this.products.find((product) => product.id === id).quantity += 1;
      localStorage.setItem("cart", JSON.stringify(this.products));
      // this.$store.dispatch("addToCart", this.products)
    },
    decrement(id) {
      let count = this.products.find((product) => product.id === id).quantity;
      if (count > 1) {
        this.products.find((product) => product.id === id).quantity -= 1;
        localStorage.setItem("cart", JSON.stringify(this.products));
      }
    },
    paymentOnline() {
      this.online = true;
    },
    paymentOffline() {
      this.online = false;
    },
    checkoutform() {
      let data = {
        user_id: this.$store.getters.user.user_id,
        fname: this.checkout.fname,
        lname: this.checkout.lname,
        email: this.checkout.email,
        contact: this.checkout.contact,
        address: `${this.checkout.address1}, ${this.checkout.address2}, ${this.checkout.city}, ${this.checkout.city}, ${this.checkout.district}, ${this.checkout.zipcode}, ${this.checkout.state}`,
        coupon: this.checkout.coupon,
      };
      let index = 0;
      for (let product of this.cart) {
        data["product_id"] = product.id;
        data["product"] = `${product.name}-(${product.brand})`;
        data["price"] = product.price;
        data["quantity"] = this.$store.getters.cart[index].quantity;
        index += 1;
        if (this.checkout.card_holder !== null) {
          data["payment_method"] = "PayPal";
        } else {
          data["payment_method"] = "COD";
        }
        placeOrder(data)
          .then((res) => {
            console.log(res.data.message);
          })
          .catch((res) => {
            console.log(res.data);
          });
        console.log(data);
      }
      // placeOrder()
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
.btn-default {
  margin: 0px;
}
.payment {
  margin-left: 20px;
}
.cash {
  margin-top: 25px;
  margin-bottom: 25px;
}
</style>