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
                <span
                  class="text-danger"
                  v-if="!$v.track.email.required && $v.track.email.$dirty"
                >
                  Email is required!
                </span>
                <span
                  class="text-danger"
                  v-if="!$v.track.email.email && $v.track.email.$dirty"
                >
                  Invalid Email!
                </span>
              </div>
              <div class="form-group">
                <input
                  type="text"
                  v-model="track.tracking_id"
                  placeholder="Tracking Id"
                />
                <span
                  class="text-danger"
                  v-if="
                    !$v.track.tracking_id.required &&
                    $v.track.tracking_id.$dirty
                  "
                >
                  Tracking Id is required!
                </span>
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
        <div class="col-sm-5 pb" v-if="status === 'Yet to be Dispatched'">
          <h2>Status</h2>
          <p class="status">
            <span>&bull;</span> Yet to be Dispatched
          </p>
        </div>
        <div class="col-sm-5 pb" v-if="status === 'Dispatched'">
          <h2>Status</h2>
          <p class="status">
            <span>&bull;</span> Yet to be Dispatched
          </p>
          <div class="line"></div>
          <p class="status">
            <span>&bull;</span> Dispatched
          </p>
        </div>
        <div class="col-sm-5 pb" v-if="status === 'Shipped'">
          <h2>Status</h2>
          <p class="status"><span>&bull;</span> Yet to be Dispatched</p>
          <div class="line"></div>
          <p class="status"><span>&bull;</span> Dispatched</p>
          <div class="line"></div>
          <p class="status"><span>&bull;</span> Shipped</p>
        </div>
        <div class="col-sm-5 pb" v-if="status === 'Arriving Today'">
          <h2>Status</h2>
          <p class="status"><span>&bull;</span> Yet to be Dispatched</p>
          <div class="line"></div>
          <p class="status"><span>&bull;</span> Dispatched</p>
          <div class="line"></div>
          <p class="status"><span>&bull;</span> Shipped</p>
          <div class="line"></div>
          <p class="status"><span>&bull;</span> Arriving Today</p>
        </div>
        <div class="col-sm-5 pb" v-if="status === 'Delivered'">
          <h2>Status</h2>
          <p class="status"><span>&bull;</span> Yet to be Dispatched</p>
          <div class="line"></div>
          <p class="status"><span>&bull;</span> Dispatched</p>
          <div class="line"></div>
          <p class="status"><span>&bull;</span> Shipped</p>
          <div class="line"></div>
          <p class="status"><span>&bull;</span> Arriving Today</p>
          <div class="line"></div>
          <p class="status"><span>&bull;</span> Delivered</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { trackOrder } from "../common/Service";
import { formatDate, formatTime } from "../common/Filter";
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
      created: null,
      updated: null,
    };
  },
  filters: {
    formatDate,
    formatTime,
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
            this.error = "Invalid Order Details";
          } else {
            this.status = res.data.status;
            this.created = res.data.created_at;
            this.created = res.data.updated_at;
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
.line {
  height: 50px;
  border-left: 2px #fe980f solid;
}
.status {
  margin-bottom: 0px;
}
.status span {
  color: #fe980f;
}
.pb {
  margin-left: auto;
  margin-right: auto;
  margin-bottom: 50px;
}

.pb h2 {
  color: #696763;
  font-family: "Roboto", sans-serif;
  font-size: 20px;
  font-weight: 300;
  margin-bottom: 30px;
}
</style>