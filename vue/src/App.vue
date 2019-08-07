<script>

export default {
  
}
</script>
<template>
 <div id="app" class="small-container">
  <router-link to="/category" class="button">Category</router-link>
  <router-link to="/product" class="button">Product</router-link>
  <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: "app",
  components: {
  },

}
</script>

<style>
.button {
  background: #009435;
  border: 1px solid #009435;
  margin: 60;
  }

.button:hover,
.button:active,
.button:focus {
  background: #32a95d;
  border: 1px solid #32a95d;
}

.small-container {
  max-width: 680px;
}
</style>
