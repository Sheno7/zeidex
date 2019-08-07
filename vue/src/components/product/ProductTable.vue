<template>
  <div id="product-table">
    <p
      v-if="products.length < 1"
      class="empty-table"
    >
      No categories
    </p>
    <table v-else>
      <thead>
        <tr>
          <th>Title</th>
          <th>Category</th>
          <th>Images</th>
        </tr>
      </thead>
      <tbody>
        <tr
          :key="product.id"
          v-for="product in products"
        >
          <td>{{product.title}}</td>
          <td>{{ product.category_name }}</td>
          <td>
            <div :key="image.id" v-for="image in product.images_path">
            <img :src="'http://localhost:5000/'+image" style="width:100px">
            </div>
            </td>

        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'category-table',
  props: {
    products: Array,
  },
  data() {
    return {
      editing: null,
    }
  },
  methods: {
  }
}
</script>

<style scoped>
button {
  margin: 0 0.5rem 0 0;
}

input {
  margin: 0;
}

.empty-table {
  text-align: center;
}
</style>
