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
                <img v-bind:src="MAIN_URL + thumbnail" alt="" class="image" />
              </div>
              <div
                id="similar-product"
                class="carousel slide"
                data-ride="carousel"
              >
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                  <div class="item active">
                    <a
                      href=""
                      v-for="(image, index) in images[0]"
                      v-bind:key="index"
                      ><img
                        v-bind:src="MAIN_URL + image.image"
                        alt=""
                        class="sm-image"
                    /></a>
                  </div>
                  <div
                    class="item"
                    v-for="(image, index) in images.slice(1)"
                    v-bind:key="index"
                  >
                    <a
                      href=""
                      v-for="(sub_image, index) in image"
                      v-bind:key="index"
                      ><img
                        v-bind:src="MAIN_URL + sub_image.image"
                        class="sm-image"
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
                <h1 v-if="product_details.featured" class="newarrival badge">
                  Featured
                </h1>
                <h2>{{ product_details.name }}</h2>
                <p>{{ product_details.brand }}</p>

                <span>
                  <span>{{ product_details.price | rupee }}</span>

                  <button
                    type="button"
                    class="btn btn-fefault cart"
                    v-on:click="addInCart()"
                  >
                    <i class="fa fa-shopping-cart"></i>
                    Add to cart
                  </button>
                </span>
                <div
                  class="features"
                  v-if="product_details.description !== null"
                >
                  <h4>Highlights</h4>
                  <p
                    v-for="feature in product_details.description.split(',')"
                    v-bind:key="feature"
                  >
                    &bull; {{ feature }}
                  </p>
                </div>
                <p>
                  <b>Availability:</b>
                  <span
                    v-if="product_details.quantity != 0"
                    class="text-success"
                  >
                    &nbsp;In Stock</span
                  >
                  <span v-else class="text-danger badge badge-success">
                    Out of Stock</span
                  >
                </p>
                <p><b>Condition:</b> New</p>
                <p><b>Brand:</b> {{ product_details.brand }}</p>
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
import { rupee } from "../common/Filter";
export default {
  name: "ProductDetails",
  data() {
    return {
      product_details: null,
      MAIN_URL: MAIN_URL,
      publicPath: process.env.BASE_URL,
      thumbnail: null,
    };
  },
  components: {
    SideBar,
  },
  mounted() {
    productDetails(this.$route.params.id).then((res) => {
      this.product_details = res.data.product;
      this.thumbnail = res.data.product.thumbnail;
      console.log(this.product_details);
    });
  },
  computed: {
    images() {
      let image_matrix = [],
        i,
        k;

      for (i = 0, k = -1; i < this.product_details.images.length; i++) {
        if (i % 3 === 0) {
          k++;
          image_matrix[k] = [];
        }

        image_matrix[k].push(this.product_details.images[i]);
      }

      return image_matrix;
    },
  },
  methods: {
    addInCart() {
      addToCart(this.product_details.id);
      console.log(this.images);
    },
  },
  filters: {
    rupee,
  },
};
</script>

<style>
.image {
  object-fit: cover;
  object-position: center;
}
.sm-image {
  object-fit: cover;
  object-position: center;
  width: 8rem;
  height: 8rem;
}
.newarrival {
  margin: 0px;
  border-radius: 0px;
}
</style>