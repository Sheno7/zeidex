<template>
  <div id="category-form">
    <form @submit.prevent="handleSubmit">

      <label>Category name</label>
      <input
        ref="first"
        type="text"
        :class="{ 'has-error': submitting && invalidName }"
        v-model="category.title"
        @focus="clearStatus"
        @keypress="clearStatus"
      >
      <p
        v-if="error && submitting"
        class="error-message"
      >❗Please fill out all required fields</p>
      <p
        v-if="success"
        class="success-message"
      >✅ Category successfully added</p>
      <button>Add Category</button>
    </form>

  </div>
</template>

<script>
export default {
  name: 'category-form',
  data() {
    return {
      error: false,
      submitting: false,
      success: false,
      category: {
        title: '',
      }
    }
  },
  computed: {
    invalidTitle() {
      return this.category.title === ''
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

      this.$emit('add:category', this.category)
      this.$refs.first.focus()
      this.category = {
        title: '',
      }
      this.success = true
      this.error = false
      this.submitting = false
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
