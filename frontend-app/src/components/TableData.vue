<template>
    <table class="table table-dark table-striped">
      <thead>
        <tr>
          <th v-for="column in columns" :key="column">{{ column }}</th>
          <th colspan="2">Actions</th> </tr>
      </thead>
      <tbody>
        <tr v-for="row in data" :key="row.id">
          <td v-for="column in columns.slice(0, -2)" :key="column">{{ row[column] }}</td> <td>
            <button class="btn btn-success" @click="editData(row)">Edit</button>
          </td>
          <td>
            <button class="btn btn-danger" @click="deleteData(row)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </template>
  
  <script>
  export default {
    props: {
      columns: Array,
      data: Array,
    },
    methods: {
      editData(row) {
        // Implement your editing logic here
        // For example, open a modal or emit an event
        console.log('Editing row:', row);
      },
      deleteData(row) {
        // Implement your deletion logic here
        // For example, confirm with the user and then remove the row from data
        console.log('Deleting row:', row);
      },
    },
  };
  </script>