<template>
  <div
    id="app"
    class="small-container"
  >
    <h1>Categories</h1>

    <category-form @add:category="addCategory" />
    <category-table
      :categories="categories"
      @delete:category="deleteCategory"
      @edit:category="editCategory"
    />
  </div>
</template>

<script>
import CategoryTable from '@/components/category/CategoryTable.vue'
import CategoryForm from '@/components/category/CategoryForm.vue'

export default {
  name: "category",
  components: {
    CategoryTable,
    CategoryForm,
  },
  data() {
    return {
      categories: []
    }
  },

  mounted() {
    this.getCategories()
  },

  methods: {
    async getCategories() {
      try {
        const response = await fetch('http://localhost:5000/api/category')
        const data = await response.json()
       await console.log('in dasi');
        this.categories = data;
      } catch (error) {
        console.error(error)
      }
    },

    async addCategory(category) {
      try {
        const response = await fetch('http://localhost:5000/api/category', {
          method: 'POST',
          body: JSON.stringify(category),
          headers: { "Content-type": "application/json"}
        });
        const data = await response.json()
        this.categories = data;
        console.log(this.categories);
      } catch (error) {
        
        console.error(error)
      }
    },

    async editCategory(id, updatedCategory) {
      try {
        const response = await fetch(`http://localhost:5000/api/category/${id}`, {
          method: 'PUT',
          body: JSON.stringify(updatedCategory),
          headers: { "Content-type": "application/json"}
        })
        const data = await response.json();
        this.categories = data;
      } catch (error) {
        console.error(error)
      }
    },

    async deleteCategory(id) {
      try {
        await fetch(`http://localhost:5000/api/category/${id}`, {
          method: 'DELETE'
        })
        this.categories = this.categories.filter(category => category.id !== id)
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
