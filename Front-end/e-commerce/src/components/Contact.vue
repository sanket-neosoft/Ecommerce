<template>
  <div id="contact-page" class="container">
    <div class="bg">
      <div class="row">
        <div class="col-sm-12">
          <h2 class="title text-center">Contact <strong>Us</strong></h2>
          <div id="gmap" class="contact-map">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15068.354509124467!2d73.1231582435741!3d19.234968861579976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7954a866ebbd1%3A0xe9010fdbbc8d4393!2sD-Mart!5e0!3m2!1sen!2sin!4v1641571768982!5m2!1sen!2sin"
              width="100%"
              height="100%"
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
            ></iframe>
          </div>
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
                  placeholder="Name"
                  v-model.trim="$v.contactForm.name.$model"
                />
                <div
                  class="text-danger"
                  v-if="
                    !$v.contactForm.name.required && $v.contactForm.name.$dirty
                  "
                >
                  Name is required!
                </div>
              </div>
              <div class="form-group col-md-6">
                <input
                  type="email"
                  name="email"
                  class="form-control"
                  placeholder="Email"
                  v-model.trim="$v.contactForm.email.$model"
                />
                <div
                  class="text-danger"
                  v-if="
                    !$v.contactForm.email.required &&
                    $v.contactForm.email.$dirty
                  "
                >
                  Email is required!
                </div>
                <div
                  class="text-danger"
                  v-if="
                    !$v.contactForm.email.email && $v.contactForm.email.$dirty
                  "
                >
                  Invalid Email!
                </div>
              </div>
              <div class="form-group col-md-12">
                <input
                  type="tel"
                  name="contact"
                  class="form-control"
                  placeholder="Contact Number"
                  v-model.trim="$v.contactForm.contact.$model"
                />
                <div
                  class="text-danger"
                  v-if="
                    !$v.contactForm.contact.required &&
                    $v.contactForm.contact.$dirty
                  "
                >
                  Contact number is required!
                </div>
                <div
                  class="text-danger"
                  v-if="
                    !$v.contactForm.contact.numeric &&
                    $v.contactForm.contact.$dirty
                  "
                >
                  Invalid contact number!
                </div>
                <div
                  class="text-danger"
                  v-if="
                    (!$v.contactForm.contact.maxLength ||
                      !$v.contactForm.contact.minLength) &&
                    $v.contactForm.contact.$dirty
                  "
                >
                  Contact number should be of 10 digits
                </div>
              </div>
              <div class="form-group col-md-12">
                <textarea
                  name="message"
                  id="message"
                  class="form-control"
                  rows="8"
                  placeholder="Your Message Here"
                  v-model.trim="$v.contactForm.message.$model"
                ></textarea>
                <div
                  class="text-danger"
                  v-if="
                    !$v.contactForm.message.required &&
                    $v.contactForm.message.$dirty
                  "
                >
                  Message is required!
                </div>
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
import { contactUs } from "../common/Service";
import Vue from "vue";
import Vuelidate from "vuelidate";
import toastr from "toastr";
import {
  required,
  email,
  numeric,
  maxLength,
  minLength,
} from "vuelidate/lib/validators";

Vue.use(Vuelidate);

export default {
  name: "Contact",
  data() {
    return {
      contactForm: {
        name: "",
        email: "",
        contact: "",
        message: "",
      },
    };
  },
  validations() {
    return {
      contactForm: {
        name: {
          required,
        },
        email: {
          required,
          email,
        },
        contact: {
          required,
          numeric,
          maxLength: maxLength(10),
          minLength: minLength(10),
        },
        message: { required },
      },
    };
  },
  methods: {
    contact() {
      this.$v.$touch();
      if (!this.$v.$invalid) {
        console.log(`Name: ${this.contactForm.name}`);
        let formData = {
          name: this.contactForm.name,
          email: this.contactForm.email,
          contact: this.contactForm.contact,
          message: this.contactForm.message,
        };
        contactUs(formData).then((res) => {
          toastr.success(res.data.message);
        });
      }
    },
  },
};
</script>

<style>
</style>