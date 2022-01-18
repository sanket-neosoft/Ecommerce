<template>
  <div class="col-sm-4">
    <div class="signup-form">
      <!--sign up form-->
      <h2>New User Signup!</h2>
      <form v-on:submit.prevent="register()">
        <div class="form-group">
          <input
            type="text"
            v-model="registerForm.fname"
            placeholder="First Name"
          />
          <span
            class="text-danger"
            v-if="
              !$v.registerForm.fname.required && $v.registerForm.fname.$dirty
            "
            >First name is required!</span
          >
          <span
            class="text-danger"
            v-if="!$v.registerForm.fname.alpha && $v.registerForm.fname.$dirty"
            >Only alphabets are allowed!</span
          >
        </div>
        <div class="form-group">
          <input
            type="text"
            v-model="registerForm.lname"
            placeholder="Last Name"
          />
          <span
            class="text-danger"
            v-if="
              !$v.registerForm.lname.required && $v.registerForm.lname.$dirty
            "
            >Last name is required!</span
          >
          <span
            class="text-danger"
            v-if="!$v.registerForm.lname.alpha && $v.registerForm.lname.$dirty"
            >Only characters are allowed!</span
          >
        </div>
        <div class="form-group">
          <input
            type="email"
            v-model="registerForm.email"
            placeholder="Email Address"
          />
          <span
            class="text-danger"
            v-if="
              !$v.registerForm.email.required && $v.registerForm.email.$dirty
            "
            >Email is required!</span
          >
          <span
            class="text-danger"
            v-if="!$v.registerForm.email.email && $v.registerForm.email.$dirty"
            >Invalid email!</span
          >
          <span class="text-danger">{{ email_err }}</span>
        </div>
        <div class="form-group">
          <input
            type="password"
            v-model="registerForm.password"
            placeholder="Password"
          />
          <span
            class="text-danger"
            v-if="
              !$v.registerForm.password.required &&
              $v.registerForm.password.$dirty
            "
            >Password is required!</span
          >
          <span
            class="text-danger"
            v-if="
              (!$v.registerForm.password.maxLength ||
                !$v.registerForm.password.minLength) &&
              $v.registerForm.password.$dirty
            "
            >Password must be between 8 to 12 characters!</span
          >
        </div>
        <div class="form-group">
          <input
            type="password"
            v-model="registerForm.cnf_password"
            placeholder="Re-enter Password"
          />
          <span
            class="text-danger"
            v-if="
              !$v.registerForm.cnf_password.sameAs &&
              $v.registerForm.cnf_password.$dirty
            "
            >Password does not match!</span
          >
        </div>
        <button type="submit" class="btn btn-default">Signup</button>
      </form>
    </div>
    <!--/sign up form-->
  </div>
</template>

<script>
import { userRegister } from "../../common/Service";
import store from "../../store";
import router from "../../router";
import Vue from "vue";
import Vuelidate from "vuelidate";
import {
  required,
  email,
  alpha,
  maxLength,
  minLength,
  sameAs,
} from "vuelidate/lib/validators";

Vue.use(Vuelidate);

export default {
  name: "RegisterFrom",
  data() {
    return {
      registerForm: {
        fname: null,
        lname: null,
        email: null,
        password: null,
        cnf_password: null,
      },
      email_err: "",
    };
  },
  validations: {
    registerForm: {
      fname: {
        required,
        alpha,
      },
      lname: {
        required,
        alpha,
      },
      email: {
        required,
        email,
      },
      password: {
        required,
        maxLength: maxLength(12),
        minLength: minLength(8),
      },
      cnf_password: {
        sameAs: sameAs("password"),
      },
    },
  },
  methods: {
    register() {
      this.$v.$touch();
      if (!this.$v.$invalid) {
        let formData = {
          fname: this.registerForm.fname,
          lname: this.registerForm.lname,
          email: this.registerForm.email,
          password: this.registerForm.password,
          password_confirmation: this.registerForm.cnf_password,
        };
        userRegister(formData)
          .then((res) => {
            localStorage.setItem("user", JSON.stringify(res.data));
            store.dispatch("user", res.data);
            router.push({ name: "Home" });
            let wishlist = [];
            store.dispatch("addToWishlist", wishlist);
            localStorage.setItem("wishlist", JSON.stringify(wishlist));
          })
          .catch((err) => {
            if (err.response.status === 400) {
              this.email_err = err.response.data.email[0];
            }
          });
      }
    },
  },
};
</script>

<style>
</style>