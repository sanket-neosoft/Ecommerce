<template>
  <section id="form">
    <!--form-->
    <div class="container">
      <div class="row">
        <LoginForm />
        <div class="col-sm-1">
          <h2 class="or">OR</h2>
        </div>
        <RegisterFrom />
      </div>
    </div>
  </section>
  <!--/form-->
</template>

<script>
import LoginForm from "./login-forms/LoginForm.vue";
import RegisterFrom from "./login-forms/RegisterForm.vue";

export default {
  name: "Login",
  components: {
    LoginForm,
    RegisterFrom,
  },
};
</script>

<style>
</style>