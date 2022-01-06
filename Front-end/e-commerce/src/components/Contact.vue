<template>
  <div id="contact-page" class="container">
    <div class="bg">
      <div class="row">
        <div class="col-sm-12">
          <h2 class="title text-center">Contact <strong>Us</strong></h2>
          <div id="gmap" class="contact-map"></div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8">
          <div class="contact-form">
            <h2 class="title text-center">Get In Touch</h2>
            <div class="status alert alert-success" style="display: none"></div>
            <form
              id="main-contact-form"
              class="contact-form row"
              v-on:submit.prevent="contact()"
            >
              <div class="form-group col-md-6">
                <input
                  type="text"
                  name="name"
                  class="form-control"
                  required="required"
                  placeholder="Name"
                  v-model="contactForm.name"
                />
              </div>
              <div class="form-group col-md-6">
                <input
                  type="email"
                  name="email"
                  class="form-control"
                  required="required"
                  placeholder="Email"
                  v-model="contactForm.email"
                />
              </div>
              <div class="form-group col-md-12">
                <input
                  type="tel"
                  name="contact"
                  class="form-control"
                  required="required"
                  placeholder="Contact Number"
                  v-model="contactForm.contact"
                />
              </div>
              <div class="form-group col-md-12">
                <textarea
                  name="message"
                  id="message"
                  required="required"
                  class="form-control"
                  rows="8"
                  placeholder="Your Message Here"
                  v-model="contactForm.message"
                ></textarea>
              </div>
              <div class="form-group col-md-12">
                <input
                  type="submit"
                  name="submit"
                  class="btn btn-primary pull-right"
                  value="Submit"
                />
              </div>
            </form>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="contact-info">
            <h2 class="title text-center">Contact Info</h2>
            <address>
              <p>E-Shopper Inc.</p>
              <p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
              <p>Newyork USA</p>
              <p>Mobile: +2346 17 38 93</p>
              <p>Fax: 1-714-252-0026</p>
              <p>Email: info@e-shopper.com</p>
            </address>
            <div class="social-networks">
              <h2 class="title text-center">Social Networking</h2>
              <ul>
                <li>
                  <a href="#"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-twitter"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-google-plus"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-youtube"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/#contact-page-->
</template>

<script>
import Vue from "vue";
import axios from "axios";
import Vueaxios from "vue-axios";

Vue.use(Vueaxios, axios);

export default {
  name: "Contact",
  data() {
    return {
      contactForm: {
        name: null,
        email: null,
        contact: null,
        message: null,
      },
      api: "http://127.0.0.1:8000/api/contactus",
    };
  },
  methods: {
    contact() {
      let formData = {
        name: this.contactForm.name,
        email: this.contactForm.email,
        contact: this.contactForm.contact,
        message: this.contactForm.message,
      };
      Vue.axios.post(this.api, formData).then((res) => {
        console.log(res.data);
      });
    },
  },
};
</script>

<style>
</style>