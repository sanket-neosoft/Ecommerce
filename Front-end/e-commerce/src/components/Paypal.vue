<template></template>

<script>
export default {
  mounted() {
    let client = {
      sandbox: "your paypal sendbox client id ",
    };
    let payment = (data, actions) => {
      // Make a call to the REST api to create the payment
      return actions.payment.create({
        payment: {
          transactions: [
            {
              amount: { total: this.amount, currency: "USD" },
            },
          ],
        },
      });
    };
    let onAuthorize = (data) => {
      var data = {
        paymentID: data.paymentID,
        payerID: data.payerID,
        amount: this.amount,
      };
      this.sendDataPaypal({ data: data })
        .then(() => {
          this.success = true; // to display the success message
        })
        .catch((err) => {
          this.error = true; // to display  the error message
        });
    };
    paypal.Button.render(
      {
        env: "sandbox", // sandbox | production
        commit: true,
        client,
        payment,
        onAuthorize,
      },
      "#paypal-button-container"
    );
  },
};
</script>

<style>
</style>