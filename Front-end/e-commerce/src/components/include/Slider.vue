<template>
  <div v-bind:class="{{class}}">
    <div class="col-sm-6">
      <h1><span>E</span>-SHOPPER</h1>
      <h2>Free E-Commerce Template</h2>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.
      </p>
      <button type="button" class="btn btn-default get">Get it now</button>
    </div>
    <div class="col-sm-6">
      <img
        v-bind:src="server + banners[0].image"
        class="girl img-responsive"
        alt=""
      />
    </div>
  </div>
</template>

<script>
export default {
  name: "Slider",
  props: {
      class: String,
      
  }
};
</script>

<style>
</style>