<script setup>
    import { RouterLink } from 'vue-router';

    import NavBar from '../../components/NavBar.vue';
    import dataAuthors from '../../composable/authors.js';  
    import { onMounted } from 'vue';

    const {authors, getAuthors} =dataAuthors();
    onMounted(()=>getAuthors());
</script>


<template>
    <NavBar />
    <div class="container-md">
        <div class="position-relative">
            <div class="position-absolute top-0 end-0">
                <RouterLink :to="{name: 'AuthorCreate'}" class="">New Author</RouterLink>
            </div>
            <table class="table">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Bio</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="author in authors" :key="author.id">
                <th scope="row">{{author.id}}</th>
                <td>{{author.AuthorName}}</td>
                <td>{{author.AuthorBio }}</td>
                <td>Edit/Delete</td>
                </tr>
            </tbody>
        </table>
        </div>
        
    </div>
    
</template>