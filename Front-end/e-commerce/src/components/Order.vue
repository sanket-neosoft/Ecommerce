<template>
  <section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><router-link to="/">Home</router-link></li>
          <li class="active">My Orders</li>
        </ol>
      </div>
      <h2 class="heading">Order History</h2>
      <div
        class="row border"
        v-for="(user_orders, index) in orders"
        v-bind:key="index"
      >
        <div class="col-md-8">
          <div
            class="row"
            v-for="(order, index) in user_orders.order_detail"
            v-bind:key="index"
          >
            <div class="col-md-4">
              <img
                class="cart_img"
                v-bind:src="MAIN_URL + order.product.thumbnail"
                alt=""
              />
            </div>
            <div class="col-md-4 margin">
              <h4>{{ order.product.name }}</h4>
              <p>{{ order.product.brand }}</p>
              <p>Quantity: {{ order.quantity }}</p>
              <p>Price:{{ order.product.price | rupee }}</p>
            </div>
            <div class="col-md-4 margin">
              <p>Ordered on: {{ order.created_at | formatDate }}</p>
              <p>{{ order.created_at | formatTime }}</p>
              <p>Tracking Id: {{ order.tracking_id }}</p>
              <p>
                SubTotal: {{ order.product.price }} * {{ order.quantity }} =
                {{ order.product.price * order.quantity }}
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4 margin text-center border-left">
          <p>Payment Method: {{ user_orders.payment_method }}</p>
          <p v-if="user_orders.coupon">Coupon: {{ user_orders.coupon }}</p>
          <p v-if="user_orders.discount !== 0">Discount: {{ user_orders.discount | rupee }}</p>
          <p>Grand Total: {{ user_orders.grand_total }}</p>
        </div>
        <hr />
      </div>
    </div>
  </section>
</template>

<script>
import { myOrders } from "../common/Service";
import { rupee, formatDate, formatTime } from "../common/Filter";
import { MAIN_URL } from "../common/Url";
export default {
  name: "Order",
  data() {
    return {
      orders: null,
      MAIN_URL: MAIN_URL,
    };
  },
  filters: {
    rupee,
    formatDate,
    formatTime,
  },
  mounted() {
    myOrders(this.$store.getters.user.user_id).then((res) => {
      this.orders = res.data.orders;
    });
  },
};
</script>

<style scoped>
.heading {
  color: #696763;
  font-family: "Roboto", sans-serif;
  font-size: 20px;
  font-weight: 300;
  margin-bottom: 30px;
}
.cart_img {
  height: 20rem;
  width: auto;
  object-fit: cover;
  object-position: center;
}
.margin {
  margin-top: 4rem;
  /* margin-bottom: auto */
}
.border {
  border-top: solid 1px #69676315;
}
.text-center {
  border-left: solid 1px #FE980F;
}
</style>