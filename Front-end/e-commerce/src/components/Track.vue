<template>
  <section id="">
    <!--form-->
    <div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><router-link to="/">Home</router-link></li>
          <li class="active">Track Orders</li>
        </ol>
      </div>
      <div class="row">
        <div class="col-sm-6 col-sm-offset-1">
          <div class="login-form">
            <!--Track order form-->
            <h2>Track Order</h2>
            <form v-on:submit.prevent="trackorder()">
              <div class="form-group">
                <input type="email" v-model="track.email" placeholder="Email" />
                <!-- <span
                  class="text-danger"
                  v-if="
                    !$v.loginForm.email.required && $v.loginForm.email.$dirty
                  "
                >
                  Email is required!
                </span>
                <span
                  class="text-danger"
                  v-if="!$v.loginForm.email.email && $v.loginForm.email.$dirty"
                >
                  Invalid Email!
                </span> -->
              </div>
              <div class="form-group">
                <input
                  type="text"
                  v-model="track.tracking_id"
                  placeholder="Order Id"
                />
              </div>
              <span class="text-danger">{{ error }}</span>
              <button type="submit" class="btn btn-default">
                Check Status
              </button>
            </form>
          </div>
          <!--/login form-->
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-5">
          <ul>
            <ol>
              {{status}}
            </ol>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <ol>
              Dispatched
            </ol>
          </ul>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { trackOrder } from "../common/Service";
import Vue from "vue";
import Vuelidate from "vuelidate";
import { required, email } from "vuelidate/lib/validators";

Vue.use(Vuelidate);

export default {
  name: "Track",
  data() {
    return {
      track: {
        email: null,
        order_id: null,
      },
      error: null,
      status: null,
    };
  },
  validations: {
    track: {
      email: { required, email },
      tracking_id: { required },
    },
  },
  methods: {
    trackorder() {
      this.$v.$touch();
      if (!this.$v.$invalid) {
        trackOrder(this.track).then((res) => {
          if (res.data.error) {
            this.error = res.data.error;
          } else {
            this.status = res.data.status;
          }
        });
      }
    },
  },
};
</script>

<style scoped>
.col-sm-offset-1 {
  margin: 0px;
  margin-bottom: 75px;
}
p {
  border-left: 1px #fe980f solid;
  margin: 0px;
}
</style>