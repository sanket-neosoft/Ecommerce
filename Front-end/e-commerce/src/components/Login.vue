<template>
  <section id="form">
    <!--form-->
    <div class="container">
      <div class="row">
        <div class="col-sm-4 col-sm-offset-1">
          <div class="login-form">
            <!--login form-->
            <h2>Login to your account</h2>
            <form v-on:submit.prevent="login()">
              <input
                type="email"
                v-model="loginForm.email"
                placeholder="Email"
              />
              <input
                type="password"
                v-model="loginForm.password"
                placeholder="Password"
              />
              <span>
                <input type="checkbox" class="checkbox" />
                Keep me signed in
              </span>
              <button type="submit" class="btn btn-default">Login</button>
            </form>
          </div>
          <!--/login form-->
        </div>
        <div class="col-sm-1">
          <h2 class="or">OR</h2>
        </div>
        <div class="col-sm-4">
          <div class="signup-form">
            <!--sign up form-->
            <h2>New User Signup!</h2>
            <form v-on:submit.prevent="register()">
              <input
                type="text"
                v-model="registerForm.fname"
                placeholder="First Name"
              />
              <input
                type="text"
                v-model="registerForm.lname"
                placeholder="Last Name"
              />
              <input
                type="email"
                v-model="registerForm.email"
                placeholder="Email Address"
              />
              <input
                type="password"
                v-model="registerForm.password"
                placeholder="Password"
              />
              <input
                type="password"
                v-model="registerForm.cnf_password"
                placeholder="Re-enter Password"
              />
              <button type="submit" class="btn btn-default">Signup</button>
            </form>
          </div>
          <!--/sign up form-->
        </div>
      </div>
    </div>
  </section>
  <!--/form-->
</template>

<script>
import { userLogin, userRegister } from "@/common/Service";
import store from "../store";
import router from "../router";

export default {
  name: "Login",
  data() {
    return {
      loginForm: {
        email: null,
        password: null,
      },
      registerForm: {
        fname: null,
        lname: null,
        email: null,
        password: null,
        cnf_password: null,
      },
    };
  },
  methods: {
    login() {
      let formData = {
        email: this.loginForm.email,
        password: this.loginForm.password,
      };
      userLogin(formData)
        .then((res) => {
          console.log(res.data);
          localStorage.setItem("user", JSON.stringify(res.data));
          store.dispatch({
            type: "user",
            user: res.data,
          });
          router.push("/");
        })
        .catch((err) => {
          console.log("Something Wrong " + err);
        });
    },
    register() {
      let formData = {
        fname: this.registerForm.fname,
        lname: this.registerForm.lname,
        email: this.registerForm.email,
        password: this.registerForm.password,
        password_confirmation: this.registerForm.cnf_password,
      };
      userRegister(formData).then((res) => {
        console.log(res.data);
      });
    },
  },
};
</script>

<style>
</style>