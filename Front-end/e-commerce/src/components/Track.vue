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
            <form v-on:submit.prevent="login()">
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
                  v-model="track.order_id"
                  placeholder="Order Id"
                />
              </div>
              <button type="submit" class="btn btn-default">
                Check Status
              </button>
            </form>
          </div>
          <!--/login form-->
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-5">
            <table>
                <tr class="color-border">
                    <td>Yet to be dispatched.</td>
                </tr>
                <tr><td></td></tr>
                <tr>
                    <td>Dispathed.</td>
                </tr>
                <tr><td></td></tr>
                <tr>
                    <td></td>
                </tr>
            </table>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "Track",
  data() {
    return {
      track: {
        email: null,
        order_id: null,
      },
    };
  },
};
</script>

<style scoped>
.col-sm-offset-1 {
  margin: 0px;
  margin-bottom: 75px;
};
.color-border {
    border-left: 1px #FE980F solid;
}
</style>