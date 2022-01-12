<template>
  <div class="login-form">
    <!--login form-->
    <h2>Change Password</h2>
    <form v-on:submit.prevent="changePassword">
      <div class="form-group">
        <label for="fname">Current Password</label>
        <input
          type="password"
          id="current"
          placeholder="Current Password"
          v-model="password.current"
        />
        <span class="text-danger" v-if="error != null">
          {{ error }}
        </span>
        <span
          class="text-danger"
          v-if="!$v.password.current.required && $v.password.current.$dirty"
          >Confirm Password is required!</span
        >
        <span
          class="text-danger"
          v-if="
            (!$v.password.current.maxLength ||
              !$v.password.current.minLength) &&
            $v.password.current.$dirty
          "
          >Password must be between 8 to 12 characters!</span
        >
      </div>
      <div class="form-group">
        <label for="fname">New Password</label>
        <input
          type="password"
          id="new"
          placeholder="New Password"
          v-model="password.new"
        />
        <span
          class="text-danger"
          v-if="!$v.password.new.required && $v.password.new.$dirty"
          >New Password is required!</span
        >
        <span
          class="text-danger"
          v-if="
            (!$v.password.new.maxLength || !$v.password.new.minLength) &&
            $v.password.new.$dirty
          "
          >Password must be between 8 to 12 characters!</span
        >
      </div>
      <div class="form-group">
        <label for="fname">Confirm Password</label>
        <input
          type="password"
          id="cnf"
          placeholder="Confirm Password"
          v-model="password.confirm"
        />
        <span
          class="text-danger"
          v-if="!$v.password.confirm.sameAs && $v.password.confirm.$dirty"
          >Password does not match!</span
        >
      </div>
      <button type="submit" class="btn btn-default">Change Password</button>
    </form>
  </div>
</template>

<script>
import Vue from "vue";
import Vuelidate from "vuelidate";
import {
  required,
  alphaNum,
  maxLength,
  minLength,
  sameAs,
} from "vuelidate/lib/validators";
import { changePassword } from "../../common/Service";
import toastr from "toastr";

Vue.use(Vuelidate);

export default {
  name: "ChangePassword",
  data() {
    return {
      password: {
        current: null,
        new: null,
        confirm: null,
        id: null,
      },
      error: null,
    };
  },
  validations: {
    password: {
      current: {
        required,
        alphaNum,
        maxLength: maxLength(12),
        minLength: minLength(8),
      },
      new: {
        required,
        alphaNum,
        maxLength: maxLength(12),
        minLength: minLength(8),
      },
      confirm: {
        sameAs: sameAs("new"),
      },
    },
  },
  methods: {
    changePassword() {
      this.$v.$touch();
      if (!this.$v.$invalid) {
        this.password.id = this.$store.getters.user.user_id;
        changePassword(this.password).then((res) => {
          if (res.data.status == 1) {
            this.error = null;
            toastr.success(res.data.message);
          } else if (res.data.status === 0) {
            this.error = "Current password is incorrect!";
          }
        });
      }
    },
  },
};
</script>

<style>
</style>