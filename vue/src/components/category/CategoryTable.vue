<template>
  <div id="category-table">
    <p
      v-if="categories.length < 1"
      class="empty-table"
    >
      No categories
    </p>
    <table v-else>
      <thead>
        <tr>
          <th>Title</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr
          :key="category.id"
          v-for="category in categories"
        >
          <td v-if="editing === category.id">
            <input
              type="text"
              v-model="category.title"
            >
          </td>
          <td v-else>{{category.title}}</td>
          <td v-if="editing === category.id">
            <button @click="editCategory(category)">Save</button>
            <button
              class="muted-button"
              @click="cancelEdit(category)"
            >Cancel</button>
          </td>
          <td v-else>
            <button @click="editMode(category)">Edit</button>
            <button @click="$emit('delete:category', category.id)">Delete</button>
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
    categories: Array,
  },
  data() {
    return {
      editing: null,
    }
  },
  methods: {
    editMode(category) {
      this.cachedCategory = Object.assign({}, category)
      this.editing = category.id
    },

    cancelEdit(category) {
      Object.assign(category, this.cachedCategory)
      this.editing = null;
    },

    editCategory(category) {
      if (category.title === '') return
      this.$emit('edit:category', category.id, category)
      this.editing = null
    }
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
