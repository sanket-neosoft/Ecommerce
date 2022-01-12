<template>
  <section id="form">
    <!--form-->
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <AccountDetails />
        </div>
        <div class="col-md-6">
          <ChangePassword />
        </div>
      </div>
      <!--/Accont details form-->
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

