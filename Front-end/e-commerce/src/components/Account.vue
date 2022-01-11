<template>
  <section id="form">
    <!--form-->
    <div class="container">
      <AccountDetails />
      <!--/Accont details form-->
      <hr />
      <ChangePassword />
    </div>
  </section>
</template>

<script>
import AccountDetails from "./forms-components/AccountDetails.vue";
import ChangePassword from "./forms-components/ChangePassword.vue";
export default {
  name: "Account",
  components: {
    AccountDetails,
    ChangePassword,
  },
};
</script>

