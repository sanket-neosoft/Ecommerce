<template>
  <div ref="paypal" style="margin-top:25px"></div>
</template>
<script type="text/javascript">
export default {
  name: "Paypal",
  mounted() {
    const script = document.createElement("script");
    script.src =
      "https://www.paypal.com/sdk/js?client-id=AYPNNxeIUYmqVJ0-1F5GryeB2Y_AZAY2lgXAVB40YhvdiPO5RN1U9cR-ksoCTADmsACKdVls8NQ1CxMq";
    script.addEventListener("load", this.setLoaded);
    document.body.appendChild(script);
  },
  methods: {
    setLoaded: function () {
      this.loaded = true;
      window.paypal
        .Buttons({
          createOrder: (data, actions) => {
            return actions.order.create({
              purchase_units: [
                {
                  description: "Your Grand total",
                  amount: {
                    currency_code: "USD",
                    value: 1000,
                  },
                },
              ],
            });
          },
        })
        .render(this.$refs.paypal);
    },
  },
};
</script>