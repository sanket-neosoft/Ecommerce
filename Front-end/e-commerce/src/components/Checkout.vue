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
                <span
                  class="text-danger"
                  v-if="!$v.checkout.fname.required && $v.checkout.fname.$dirty"
                >
                  First name is required!
                </span>
                <span
                  class="text-danger"
                  v-if="!$v.checkout.fname.alpha && $v.checkout.fname.$dirty"
                >
                  Only alphabets are allowed!
                </span>
                <input
                  type="text"
                  placeholder="Last Name"
                  v-model="checkout.lname"
                />
                <span
                  class="text-danger"
                  v-if="!$v.checkout.lname.required && $v.checkout.lname.$dirty"
                >
                  Last name is required!
                </span>
                <span
                  class="text-danger"
                  v-if="!$v.checkout.lname.alpha && $v.checkout.lname.$dirty"
                >
                  Only alphabets are allowed!
                </span>
                <input
                  type="text"
                  placeholder="Email"
                  v-model="checkout.email"
                />
                <span
                  class="text-danger"
                  v-if="!$v.checkout.email.required && $v.checkout.email.$dirty"
                >
                  Email is required!
                </span>
                <span
                  class="text-danger"
                  v-if="!$v.checkout.email.email && $v.checkout.email.$dirty"
                >
                  Invalid Email!
                </span>
                <input
                  type="tel"
                  placeholder="Contact Number"
                  v-model="checkout.contact"
                />
                <span
                  class="text-danger"
                  v-if="
                    !$v.checkout.contact.required && $v.checkout.contact.$dirty
                  "
                >
                  Contact is required!
                </span>
                <span
                  class="text-danger"
                  v-if="
                    (!$v.checkout.contact.numeric ||
                      !$v.checkout.contact.minLength ||
                      !$v.checkout.contact.maxLength) &&
                    $v.checkout.contact.$dirty
                  "
                >
                  Invalid Contact Number!
                </span>
              </form>
            </div>
          </div>
          <div class="col-sm-8 clearfix">
            <div class="bill-to">
              <p>Billing Address</p>
              <div class="form-one">
                <form>
                  <input
                    type="text"
                    placeholder="Address 1 *"
                    v-model="checkout.address1"
                  />
                  <span
                    class="text-danger"
                    v-if="
                      !$v.checkout.address1.required &&
                      $v.checkout.address1.$dirty
                    "
                  >
                    Address is required!
                  </span>

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
                  <span
                    class="text-danger"
                    v-if="!$v.checkout.city.required && $v.checkout.city.$dirty"
                  >
                    City is required!
                  </span>

                  <input
                    type="text"
                    placeholder="District *"
                    v-model="checkout.district"
                  />
                  <span
                    class="text-danger"
                    v-if="
                      !$v.checkout.district.required &&
                      $v.checkout.district.$dirty
                    "
                  >
                    District is required!
                  </span>
                </form>
              </div>
              <div class="form-two">
                <form>
                  <input
                    type="text"
                    placeholder="State *"
                    v-model="checkout.state"
                  />
                  <span
                    class="text-danger"
                    v-if="
                      !$v.checkout.state.required && $v.checkout.state.$dirty
                    "
                  >
                    State is required!
                  </span>
                  <input
                    type="text"
                    placeholder="Pincode *"
                    v-model="checkout.zipcode"
                  />
                  <span
                    class="text-danger"
                    v-if="
                      !$v.checkout.zipcode.required &&
                      $v.checkout.zipcode.$dirty
                    "
                  >
                    Pincode is required!
                  </span>
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
            <tr v-if="cart.length !== 0">
              <td colspan="2">
                <div class="payment shopper-info">
                  <h4>Apply Coupon</h4>
                  <div class="login-form">
                    <form v-on:submit.prevent="checkCoupon()">
                      <input
                        type="text"
                        placeholder="Enter Coupon Code"
                        v-model="checkout.coupon"
                      />
                      <span v-if="coupon_error !== ''" class="text-danger">{{
                        coupon_error
                      }}</span>
                      <button class="btn btn-default">Apply</button>
                    </form>
                  </div>
                </div>
              </td>
            </tr>
            <tr v-if="cart.length !== 0">
              <td colspan="2">
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
                  <div class="login-form">
                    <form>
                      <div class="" v-if="online">
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
                      <button
                        type="button"
                        v-on:click="checkoutform()"
                        class="btn btn-default"
                      >
                        Checkout
                      </button>
                    </form>
                  </div>
                </div>
              </td>
              <td colspan="2"></td>
              <td colspan="2" class="">
                <section id="" v-if="cart.length !== 0">
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
                        Discount <span>{{ discount }}</span>
                      </li>
                      <li class="text-orange">
                        Total
                        <span v-if="subTotal < 500">{{
                          subTotal + shipping_cost - discount
                        }}</span
                        ><span v-else>{{ subTotal - discount }}</span>
                      </li>
                    </ul>
                  </div>
                </section>
                <!-- <table class="table table-condensed total-result">
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
                </table> -->
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
import {
  productDetails,
  accountDetails,
  placeOrder,
  getCoupon,
  usedCoupon,
  orderDetail,
  couponCount,
} from "../common/Service";
import { MAIN_URL } from "../common/Url";
import toastr from "toastr";
import Vue from "vue";
import Vuelidate from "vuelidate";
import {
  required,
  alpha,
  email,
  numeric,
  minLength,
  maxLength,
} from "vuelidate/lib/validators";

Vue.use(Vuelidate);

export default {
  name: "Checkout",
  data() {
    return {
      MAIN_URL: MAIN_URL,
      cart: [],
      coupon_error: "",
      coupon_status: false,
      products: [],
      coupon_details: {
        percent: 0,
      },
      shipping_cost: 50,
      online: false,
      checkout: {
        fname: null,
        id: null,
        lname: null,
        email: null,
        contact: null,
        address1: null,
        address2: "",
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
  validations: {
    checkout: {
      fname: { required, alpha },
      lname: { required, alpha },
      email: { required, email },
      contact: {
        required,
        numeric,
        minLength: minLength(10),
        maxLength: maxLength(10),
      },
      address1: { required },
      city: { required },
      district: { required },
      state: { required },
      zipcode: { required },
    },
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
      this.checkout.id = res.data.id;
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
    discount: function () {
      let discount = 0;
      if (this.coupon_details.percent !== null) {
        if (this.subTotal > 500) {
          discount = this.subTotal * (this.coupon_details.percent / 100);
        } else {
          discount =
            (this.subTotal + this.shipping_cost) *
            (this.coupon_details.percent / 100);
        }
        if (discount > this.coupon_details.limit) {
          discount = this.coupon_details.limit;
        }
      } else {
        return 0;
      }
      if (Number.isNaN(discount)) {
        return 0;
      } else if (this.subTotal < this.coupon_details.minvalue) {
        return 0;
      } else if (!this.coupon_status) {
        return 0;
      } else {
        return discount;
      }
    },
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
    checkCoupon() {
      getCoupon(this.checkout.coupon).then((res) => {
        if (res.data.coupon != null) {
          this.coupon_details = res.data.coupon;
          usedCoupon(this.checkout.id).then((res) => {
            if (res.data.coupon_used.includes(this.coupon_details.id)) {
              this.coupon_error = "You already used this coupon!";
            } else if (this.subTotal < this.coupon_details.minvalue) {
              this.coupon_error = `Cannot apply this coupon Sub total must be more than ${this.coupon_details.minvalue}`;
            } else {
              this.coupon_error = "Coupon applied Successfully.";
              this.coupon_status = true;
            }
          });
        } else {
          this.coupon_details.percent = 0;
          this.coupon_error = "Invalid Coupon Code!";
        }
      });
    },
    paymentOnline() {
      this.online = true;
    },
    paymentOffline() {
      this.online = false;
    },
    checkoutform() {
      this.$v.$touch();
      if (!this.$v.$invalid) {
        let coupon = null;
        if (this.coupon_status) {
          coupon = this.checkout.coupon;
        }
        let grand_total = 0;
        if (this.subTotal < 500) {
          grand_total = this.subTotal + this.shipping_cost - this.discount;
        } else {
          grand_total = this.subTotal - this.discount;
        }
        let data = {
          user_id: this.checkout.id,
          fname: this.checkout.fname,
          lname: this.checkout.lname,
          email: this.checkout.email,
          contact: this.checkout.contact,
          address: `${this.checkout.address1}, ${this.checkout.address2}, ${this.checkout.city}, ${this.checkout.district}, ${this.checkout.zipcode}, ${this.checkout.state}`,
          coupon: coupon,
          discount: this.discount,
          grand_total: grand_total,
        };
        if (this.coupon_details.id) {
          data["coupon_id"] = this.coupon_details.id;
        }
        if (this.checkout.card_holder !== null) {
          data["payment_method"] = "PayPal";
        } else {
          data["payment_method"] = "COD";
        }
        placeOrder(data).then((res) => {
          let order_details = {
            user_order_id: res.data.id,
          };
          let index = 0;
          for (let product of this.cart) {
            order_details["product_id"] = product.id;
            order_details["quantity"] =
              this.$store.getters.cart[index].quantity;
            index += 1;
            orderDetail(order_details).then((res) => {
              console.log(res.data);
            });
          }
          this.cart = [];
          this.$store.dispatch("addToCart", []);
          localStorage.setItem("cart", JSON.stringify([]));
          if (this.coupon_status) {
            couponCount(this.coupon_details.id);
          }
          toastr.success("Your order placed successfully.");
        });
        // let index = 0;
        // for (let product of this.cart) {
        //   data["product_id"] = product.id;
        //   data["product"] = `${product.name}-(${product.brand})`;
        //   data["price"] = product.price;
        //   data["quantity"] = this.$store.getters.cart[index].quantity;
        //   index += 1;
        //   if (this.checkout.card_holder !== null) {
        //     data["payment_method"] = "PayPal";
        //   } else {
        //     data["payment_method"] = "COD";
        //   }
        //   console.log(data);
        //   placeOrder(data).then((res) => {
        //     console.log(res.data);
        //     if (res.data.message === "Order registered") {
        //       this.cart = this.cart.filter((value) => value.id != product.id);
        //       toastr.success("Your order placed successfully.");
        //     }
        //   });
        // }
        // this.$store.dispatch("addToCart", []);
        // localStorage.setItem("cart", JSON.stringify([]));
        // couponCount(this.coupon_details.id);
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