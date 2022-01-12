<template>
  <div class="login-form">
    <!--login form-->
    <h2>Account Details</h2>
    <form v-on:submit.prevent="update()">
      <input type="hidden" v-model="data.id" value="" />
      <div class="form-group">
        <label for="fname">First Name</label>
        <input
          type="text"
          id="fname"
          placeholder="First Name"
          v-model="data.fname"
        />
        <span
          class="text-danger"
          v-if="!$v.data.fname.required && $v.data.fname.$dirty"
          >First name is required!</span
        >
        <span
          class="text-danger"
          v-if="!$v.data.fname.alpha && $v.data.fname.$dirty"
          >Only alphabets are allowed!</span
        >
      </div>
      <div class="form-group">
        <label for="lname">Last Name</label>
        <input
          type="text"
          id="lname"
          placeholder="Last Name"
          v-model="data.lname"
        />
        <span
          class="text-danger"
          v-if="!$v.data.lname.required && $v.data.lname.$dirty"
          >Last name is required!</span
        >
        <span
          class="text-danger"
          v-if="!$v.data.lname.alpha && $v.data.lname.$dirty"
          >Only characters are allowed!</span
        >
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input
          type="text"
          id="email"
          disabled
          placeholder="Email"
          v-model="data.email"
        />
      </div>
      <button type="submit" class="btn btn-default">Update</button>
    </form>
  </div>
</template>

<script>
import Vue from "vue";
import Vuelidate from "vuelidate";
import { required, alpha } from "vuelidate/lib/validators";
import { accountDetails, updateAccountDetails } from "../../common/Service";
import toastr from "toastr";

Vue.use(Vuelidate);
export default {
  name: "AccountDetails",
  data() {
    return {
      data: {
        id: null,
        fname: null,
        lname: null,
        email: null,
      },
    };
  },
  validations: {
    data: {
      fname: { required, alpha },
      lname: { required, alpha },
    },
  },
  mounted() {
    accountDetails().then((res) => {
      this.data.fname = res.data.firstname;
      this.data.lname = res.data.lastname;
      this.data.email = res.data.email;
      this.data.id = res.data.id;
      console.log(res.data);
    });
  },
  methods: {
    update() {
      this.$v.$touch();
      if (!this.$v.$invalid) {
        updateAccountDetails(this.data).then((res) => {
          toastr.success(res.data.message);
        });
      }
    },
  },
};
</script>

<style scoped>
#address {
  padding: 10px;
  font-weight: 300;
}
</style>