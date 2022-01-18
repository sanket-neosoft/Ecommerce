<template>
  <div class="col-sm-4 col-sm-offset-1">
    <div class="login-form">
      <!--login form-->
      <h2>Login to your account</h2>
      <span class="text-danger">{{ error }}</span>
      <form v-on:submit.prevent="login()">
        <div class="form-group">
          <input type="email" v-model="loginForm.email" placeholder="Email" />
          <span
            class="text-danger"
            v-if="!$v.loginForm.email.required && $v.loginForm.email.$dirty"
          >
            Email is required!
          </span>
          <span
            class="text-danger"
            v-if="!$v.loginForm.email.email && $v.loginForm.email.$dirty"
          >
            Invalid Email!
          </span>
        </div>
        <div class="form-group">
          <input
            type="password"
            v-model="loginForm.password"
            placeholder="Password"
          />
          <span
            class="text-danger"
            v-if="
              !$v.loginForm.password.required && $v.loginForm.password.$dirty
            "
          >
            Password is required!
          </span>
        </div>
        <!-- <span>
          <input type="checkbox" class="checkbox" />
          Keep me signed in
        </span> -->
        <button type="submit" class="btn btn-default">Login</button>
        <!-- <facebook-login
          class="button"
          appId="2927155020864450"
          @login="getUserData"
          @logout="onLogout"
          @get-initial-status="getUserData"
        >
        </facebook-login> -->
      </form>
    </div>
    <!--/login form-->
  </div>
</template>

<script>
import { userLogin, userWishlist } from "../../common/Service";
import store from "../../store";
import router from "../../router";
import Vue from "vue";
import Vuelidate from "vuelidate";
import { required, email } from "vuelidate/lib/validators";
// import facebookLogin from 'facebook-login-vuejs';

Vue.use(Vuelidate);

export default {
  name: "LoginForm",
  data() {
    return {
      loginForm: {
        email: null,
        password: null,
      },
      error: "",
    };
  },
  components: {
    // facebookLogin,
  },
  validations: {
    loginForm: {
      email: {
        required,
        email,
      },
      password: {
        required,
      },
    },
  },
  methods: {
    login() {
      this.$v.$touch();
      if (!this.$v.$invalid) {
        let formData = {
          email: this.loginForm.email,
          password: this.loginForm.password,
        };
        userLogin(formData)
          .then((res) => {
            localStorage.setItem("user", JSON.stringify(res.data));
            store.dispatch("user", res.data);
            userWishlist(store.getters.user.user_id).then((res) => {
              let wishlist = [];
              res.data.product.map((product) =>
                wishlist.push(product.product_id)
              );
              store.dispatch("addToWishlist", wishlist);
              localStorage.setItem("wishlist", JSON.stringify(wishlist));
            });
            router.push({ name: "Home" });
          })
          .catch((err) => {
            if (err.response.status === 401) {
              this.error = "Invalid Credentails";
            }
          });
      }
    },
  },
};
</script>

<style>
</style>