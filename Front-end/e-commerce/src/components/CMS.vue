<template>
  <div>
    <div class="container">
      <div class="row">
        <SideBar />
        <div class="col-sm-9 padding-right">
          <div class="features_items">
            <!--features_items-->
            <h2 class="title text-center">{{ title }}</h2>
            <img v-bind:src="MAIN_URL + image" alt="" />
            <h2 class="padding">{{ title }}</h2>
            <p>{{ description }}</p>
          </div>
          <!--features_items-->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SideBar from "./SideBar.vue";
import { cms } from "../common/Service";
import MAIN_URL from "../common/Url";
export default {
  name: "CMS",
  data() {
    return {
      param: null,
      MAIN_URL: MAIN_URL,
      title: null,
      image: null,
      description: null,
    };
  },
  components: {
    SideBar,
  },
  mounted() {
    this.param = this.$route.params.slug;
    cms(this.param).then((res) => {
      this.title = res.data.cms.title;
      this.image = res.data.cms.image;
      this.description = res.data.cms.description;
    });
  },
  watch: {
    $route(to) {
      cms(to.params.slug).then((res) => {
        this.title = res.data.cms.title;
        this.image = res.data.cms.image;
        this.description = res.data.cms.description;
      });
    },
  },
};
</script>

<style scoped>
img {
  height: 30rem;
  width: 100%;
  object-position: center;
  object-fit: cover;
}
p {
  padding: 20px;
  text-align: justify;
}
.padding {
  padding-left: 20px;
}
</style>