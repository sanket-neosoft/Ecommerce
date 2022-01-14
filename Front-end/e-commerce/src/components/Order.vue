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
      <div class="table-responsive">
        <table class="table table-condensed">
          <tbody>
            <tr v-for="(product, index) in orders" v-bind:key="index">
              <td>
                <h4>{{ product.order_id }}</h4>
              </td>
              <td>
                <h4>{{ product.product }}</h4>
                <p class="text-muted">hello</p>
              </td>
              <td>
                <h4>{{ product.order_quantity }}</h4>
              </td>
              <td>
                <h4>{{ product.order_price * product.order_quantity }}</h4>
              </td>
              <td>
                <h4>{{ product.payment_method }}</h4>
              </td>
              <td>
                <p class="text-muted">{{ date }}</p>
                <p class="text-muted">{{ time }}</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</template>

<script>
import { myOrders } from "../common/Service";
import moment from "moment";
export default {
  name: "Order",
  data() {
    return {
      orders: null,
      date: null,
      time: null,
    };
  },
  mounted() {
    myOrders(this.$store.getters.user.user_id).then((res) => {
      this.orders = res.data.orders;
      console.log(this.orders);
      this.date = moment(res.data.orders.created_at).utc().format("MMM Do YY");
      this.time = moment(res.data.orders.created_at).utc().format("h:mm a");
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
</style>