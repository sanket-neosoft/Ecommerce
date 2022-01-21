<template>
  <div>
    <button class="btn btn-default update" v-on:click="paymentOffline">
      Cash on delivery
    </button>
    <button class="btn btn-default update" v-on:click="paymentOnline">
      Paypal
    </button>

    <div class="" v-if="online">
      <Paypal />
    </div>
    <div v-else>
      <p class="cash">Payment method is select as Cash on Delivery</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      online: false,
    };
  },
  methods: {
    paymentOnline() {
      this.online = true;
    },
    paymentOffline() {
      this.online = false;
    },
  },
};
</script>

<style>
</style>