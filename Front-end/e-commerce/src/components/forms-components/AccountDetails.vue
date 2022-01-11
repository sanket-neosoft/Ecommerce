<template>
  <div class="login-form">
    <!--login form-->
    <h2>Account Details</h2>
    <form class="row" v-on:submit.prevent="update()">
      <div class="col-md-6">
        <input type="hidden" v-model="data.id" value="" />
        <div class="form-group">
          <label for="fname">First Name</label>
          <input
            type="text"
            id="fname"
            placeholder="First Name"
            v-model="data.fname"
          />
        </div>
        <div class="form-group">
          <label for="lname">Last Name</label>
          <input
            type="text"
            id="lname"
            placeholder="Last Name"
            v-model="data.lname"
          />
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
        <div class="form-group">
          <label for="contact">Contact Number</label>
          <input
            type="text"
            id="contact"
            placeholder="Contact Number"
            v-model="data.phone"
          />
        </div>
      </div>
      <div class="col-md-6" id="address-col">
        <div class="formgroup">
          <label for="address">Address</label>
          <textarea
            name="Address"
            placeholder="Address"
            id="address"
            rows="6"
            v-model="data.address"
          ></textarea>
        </div>
        <!-- </div>
          <div class="col-md-6"> -->
        <button type="submit" class="btn btn-default">Update</button>
      </div>
    </form>
  </div>
</template>

<script>
import { accountDetails, updateAccountDetails } from "../../common/Service";
import toastr from "toastr";
export default {
  name: "AccountDetails",
  data() {
    return {
      data: {
        id: null,
        fname: null,
        lname: null,
        email: null,
        address: null,
        phone: null,
      },
    };
  },
  mounted() {
    accountDetails().then((res) => {
      this.data.fname = res.data.firstname;
      this.data.lname = res.data.lastname;
      this.data.email = res.data.email;
      this.data.address = res.data.address;
      this.data.phone = res.data.contact_number;
      this.data.id = res.data.id;
      console.log(res.data);
    });
  },
  methods: {
    update() {
      updateAccountDetails(this.data).then((res) => {
          toastr.success(res.data.message);
      });
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