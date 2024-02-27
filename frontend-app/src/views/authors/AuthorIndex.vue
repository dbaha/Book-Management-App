<script setup>
    import { RouterLink } from 'vue-router';

    import NavBar from '../../components/NavBar.vue';
    import dataAuthors from '../../composable/authors.js';  
    import { onMounted } from 'vue';

    const {authors, getAuthors,destroyAuthor} =dataAuthors();
    onMounted(()=>getAuthors());
</script>


<template>
    <NavBar />
    <div class="container-md">
        <div class="position-relative">
            <div class="position-absolute top-0 end-0">
                <RouterLink :to="{name: 'AuthorCreate'}" class="btn btn-success">New Author</RouterLink>
            </div>
            <table class="table">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Bio</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(author,index) in authors" :key="author.id">
                    <th scope="row">{{index + 1}}</th>
                    <td>{{author.AuthorName}}</td>
                    <td>{{author.AuthorBio }}</td>
                    <td>
                        <div class="row">
                        <RouterLink :to="{name: 'AuthorEdit', params:{id: author.id}}" class="btn btn-primary col mx-2 ">編集</RouterLink>
                        <button class="btn btn-danger col mx-2" @click="destroyAuthor(author.id)"> 削除 </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
    
</template>