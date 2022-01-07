<template>
  <section id="slider">
    <!--slider-->
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div id="slider-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li
                data-target="#slider-carousel"
                data-slide-to="0"
                class="active"
              ></li>
              <li
                v-for="(banner, index) in banners"
                v-bind:key="index"
                data-target="#slider-carousel"
                v-bind:data-slide-to="index + 1"
              ></li>
            </ol>

            <div class="carousel-inner">
              <div class="item active">
                <div class="col-sm-6">
                  <h1><span>E</span>-SHOPPER</h1>
                  <h2>Free E-Commerce Template</h2>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna
                    aliqua.
                  </p>
                  <button type="button" class="btn btn-default get">
                    Get it now
                  </button>
                </div>
                <div class="col-sm-6">
                  <img
                    v-bind:src="MAIN_URL + defalult_banner.image"
                    class="girl img-responsive"
                    alt=""
                  />
                </div>
              </div>
              <div
                class="item"
                v-for="(banner, index) in banners"
                v-bind:key="index"
              >
                <div class="col-sm-6">
                  <h1><span>E</span>-SHOPPER</h1>
                  <h2>100% Responsive Design</h2>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna
                    aliqua.
                  </p>
                  <button type="button" class="btn btn-default get">
                    Get it now
                  </button>
                </div>
                <div class="col-sm-6">
                  <img
                    v-bind:src="MAIN_URL + banner.image"
                    class="girl img-responsive"
                    alt=""
                  />
                </div>
              </div>
            </div>

            <a
              href="#slider-carousel"
              class="left control-carousel hidden-xs"
              data-slide="prev"
            >
              <i class="fa fa-angle-left"></i>
            </a>
            <a
              href="#slider-carousel"
              class="right control-carousel hidden-xs"
              data-slide="next"
            >
              <i class="fa fa-angle-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/slider-->
</template>

<script>
import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios";
import { banners } from "@/common/Service";
import MAIN_URL from "../common/Url";

Vue.use(VueAxios, axios);

export default {
  name: "Carousel",
  data() {
    return {
      banners: "",
      MAIN_URL: MAIN_URL,
      defalult_banner: "",
    };
  },
  mounted() {
    banners().then((res) => {
      this.banners = res.data.banners.slice(1);
      this.defalult_banner = res.data.banners[0];
    });
  },
};
</script>

<style>
</style>