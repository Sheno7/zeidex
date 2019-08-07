<template>
  <div
    id="product"
    class="small-container"
  >
    <h1>products</h1>

    <product-form @add:product="addProduct"  :categories="categories" />
    <product-table
      :products="products"
    />
  </div>
</template>

<script>
import ProductTable from '@/components/product/ProductTable.vue'
import ProductForm from '@/components/product/ProductForm.vue'

export default {
  name: "product",
  components: {
    ProductTable,
    ProductForm,
  },
  data() {
    return {
      products: [],
       categories: []
    }
  },

  mounted() {
    this.getProducts()
    this.getCategories();
  },

  methods: {
    async getProducts() {
      try {
        const response = await fetch('http://localhost:5000/api/product')
        const data = await response.json()
       await console.log('in dasi');
        this.products = data;
      } catch (error) {
        console.error(error)
      }
    },
     async getCategories() {
      try {
        const response = await fetch('http://localhost:5000/api/product')
        const data = await response.json()
       await console.log('in dasi');
        this.categories = data;
        console.log(data);
      } catch (error) {
        console.error(error)
      }
    },

    async addProduct(product) {
      try {
          console.log(product.get('title'));
        this.$http.post('http://localhost:5000/api/product',product ,{headers: { "Content-Type": "multipart/form-data"}}).then((response)=>{
          this.products=response.data;
        });
          
        
        console.log(this.products);
      } catch (error) {
        
        console.error(error)
      }
    },


  },
}
</script>

<style>
button {
  background: #009435;
  border: 1px solid #009435;
}

button:hover,
button:active,
button:focus {
  background: #32a95d;
  border: 1px solid #32a95d;
}

.small-container {
  max-width: 680px;
}
</style>
