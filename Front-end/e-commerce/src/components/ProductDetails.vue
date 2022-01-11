<template>
  <div>
    <div class="container">
      <div class="row">
        <SideBar />

        <div class="col-sm-9 padding-right">
          <div class="product-details">
            <!--product-details-->
            <div class="col-sm-5">
              <div class="view-product">
                <img v-bind:src="MAIN_URL + product_details.thumbnail" alt="" />
                <h3>ZOOM</h3>
              </div>
              <div
                id="similar-product"
                class="carousel slide"
                data-ride="carousel"
              >
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                  <div class="item active">
                    <a href=""
                      ><img
                        v-bind:src="`${publicPath}images/product-details/similar1.jpg`"
                        alt=""
                    /></a>
                    <a href=""
                      ><img
                        v-bind:src="`${publicPath}images/product-details/similar2.jpg`"
                        alt=""
                    /></a>
                    <a href=""
                      ><img
                        v-bind:src="`${publicPath}images/product-details/similar3.jpg`"
                        alt=""
                    /></a>
                  </div>
                  <div class="item">
                    <a href=""
                      ><img
                        v-bind:src="`${publicPath}images/product-details/similar1.jpg`"
                        alt=""
                    /></a>
                    <a href=""
                      ><img
                        v-bind:src="`${publicPath}images/product-details/similar2.jpg`"
                        alt=""
                    /></a>
                    <a href=""
                      ><img
                        v-bind:src="`${publicPath}images/product-details/similar3.jpg`"
                        alt=""
                    /></a>
                  </div>
                  <div class="item">
                    <a href=""
                      ><img
                        v-bind:src="`${publicPath}images/product-details/similar1.jpg`"
                        alt=""
                    /></a>
                    <a href=""
                      ><img
                        v-bind:src="`${publicPath}images/product-details/similar2.jpg`"
                        alt=""
                    /></a>
                    <a href=""
                      ><img
                        v-bind:src="`${publicPath}images/product-details/similar3.jpg`"
                        alt=""
                    /></a>
                  </div>
                </div>

                <!-- Controls -->
                <a
                  class="left item-control"
                  href="#similar-product"
                  data-slide="prev"
                >
                  <i class="fa fa-angle-left"></i>
                </a>
                <a
                  class="right item-control"
                  href="#similar-product"
                  data-slide="next"
                >
                  <i class="fa fa-angle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-sm-7">
              <div class="product-information">
                <!--/product-information-->
                <img
                  :src="`${publicPath}images/product-details/new.jpg`"
                  class="newarrival"
                  alt=""
                />
                <h2>{{ product_details.brand }} {{ product_details.name }}</h2>
                <p>Web ID: 1089772</p>
                <img
                  :src="`${publicPath}images/product-details/rating.png`"
                  alt=""
                />
                <span>
                  <span>US $59</span>
                  <label>Quantity:</label>
                  <input type="text" value="3" />
                  <button
                    type="button"
                    class="btn btn-fefault cart"
                    v-on:click="addInCart()"
                  >
                    <i class="fa fa-shopping-cart"></i>
                    Add to cart
                  </button>
                </span>
                <p><b>Availability:</b> In Stock</p>
                <p><b>Condition:</b> New</p>
                <p><b>Brand:</b> E-SHOPPER</p>
                <a href=""
                  ><img
                    v-bind:src="`${publicPath}images/product-details/share.png`"
                    class="share img-responsive"
                    alt=""
                /></a>
              </div>
              <!--/product-information-->
            </div>
          </div>
          <!--/product-details-->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { productDetails, addToCart } from "../common/Service";
import SideBar from "./SideBar.vue";
import { MAIN_URL } from "../common/Url";
export default {
  name: "ProductDetails",
  data() {
    return {
      product_details: null,
      MAIN_URL: MAIN_URL,
      publicPath: process.env.BASE_URL,
    };
  },
  components: {
    SideBar,
  },
  mounted() {
    productDetails(this.$route.params.id).then((res) => {
      this.product_details = res.data.product;
    });
    console.log(this.$route.params);
  },
  methods: {
    addInCart() {
      addToCart(this.product_details.id);
    }
  }
};
</script>

<style>
</style>