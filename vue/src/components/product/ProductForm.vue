<template>
  <div id="product-form">
    <form @submit.prevent="handleSubmit" enctype="multipart/form-data">

      <label>product name</label>
      <input
        ref="first"
        type="text"
        :class="{ 'has-error': submitting && invalidName }"
        v-model="product.title"
        @focus="clearStatus"
        @keypress="clearStatus"
      >
      <select v-model="product.category_id">
        <option :key="category.id" :value="category.id" v-for="category in categories">{{ category.title }}</option>
      </select>
      <input type="file" multiple @change="fileSelected">
      <p
        v-if="error && submitting"
        class="error-message"
      >❗Please fill out all required fields</p>
      <p
        v-if="success"
        class="success-message"
      >✅ product successfully added</p>
      <button>Add product</button>
    </form>

  </div>
</template>

<script>
export default {
  name: 'product-form',
    props: {
    categories: Array,
  },
  data() {
    return {
      error: false,
      submitting: false,
      success: false,
      product: {
        title: '',
        category_id:'',
        images:'',
      },
      images:[],
       formData:new FormData()
    }
  },
  
  computed: {
    invalidTitle() {
      return this.product.title === ''
    },
  },
  methods: {
    handleSubmit() {
      this.clearStatus()
      this.submitting = true

      if (this.invalidtitle) {
        this.error = true
        return
      }
      this.formData.append('title',this.product.title);
      this.formData.append('category_id',this.product.category_id);
 
       this.$emit('add:product', this.formData)
      this.$refs.first.focus()
      this.product = {
        title: '',
      }
      this.success = true
      this.error = false
      this.submitting = false
    },
    fileSelected(event){
       this.formData.append('images',event.target.files[0]);
    },
  
    clearStatus() {
      this.success = false
      this.error = false
    }
  }}
</script>

<style scoped>
form {
  margin-bottom: 2rem;
}

[class*="-message"] {
  font-weight: 500;
}

.error-message {
  color: #d33c40;
}

.success-message {
  color: #32a95d;
}
</style>
