<script setup>
import NavBar from'../components/NavBar.vue';
</script>

<template>
    <NavBar />
    <h1>homeee</h1>
    <TableData :columns="['Title','AuthorName','Genre','PublishedDate']" :data="tableData" v-if="!loading"/>
    <div v-if="loading">Loading...</div>
    <div v-if="error">Error: {{ error.message }}</div>
</template>
