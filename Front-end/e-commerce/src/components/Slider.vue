<template>
  <section id="slider">
    <!--slider-->
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div id="slider-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <span v-for="(banner, index) in banners" v-bind:key="index">
                <li data-target="#slider-carousel"></li>
              </span>
              <!-- <li
                data-target="#slider-carousel"
                data-slide-to="0"
                class="active"
              ></li>
              <li data-target="#slider-carousel" data-slide-to="1"></li>
              <li data-target="#slider-carousel" data-slide-to="2"></li> -->
            </ol>

            <div class="carousel-inner">
              <div
                v-for="(banner, index) in banners"
                v-bind:key="banner.id"
                v-bind:index="index"
              >
                <div class="item">
                  <div class="col-sm-6">
                    <h1><span>E</span>-SHOPPER</h1>
                    <h2>Free Ecommerce Template</h2>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua.
                    </p>
                    <button type="button" class="btn btn-default get">
                      get now
                    </button>
                  </div>
                  <div class="col-sm-6">
                    <img
                      v-bind:src="server + banner.image"
                      class="girl img-responsive"
                      alt=""
                    />
                  </div>
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

Vue.use(VueAxios, axios);

export default {
  data() {
    return {
      api: "http://127.0.0.1:8000/api/banners",
      server: "http://127.0.0.1:8000/",
      banners: null,
      i: 0,
    };
  },
  mounted() {
    Vue.axios.get(this.api).then((response) => {
      this.banners = response.data.banners;
      console.log(response.data);
    });
  },
};
</script>

<style>
</style>