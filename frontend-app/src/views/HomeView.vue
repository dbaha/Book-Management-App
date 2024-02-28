<script setup>
import { onMounted } from 'vue';
import NavBar from'../components/NavBar.vue';
import dataBooks from '@/composable/books.js'
import dataAuthors from '@/composable/authors.js'

const {books,getBooks}=dataBooks();
const {authors,getAuthors}=dataAuthors();
    onMounted(()=>{
        getBooks();
        getAuthors();
    });
</script>

<template>
    <NavBar />
    <h3 class="display-3 text-center">This is home page for books </h3>
    <div class="container">
        <div class="row">
            <div class="col-md-6 books-container">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Title Book</th>
                        <th scope="col">Author Name</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Published date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(book,index) in books" :key="book.id">
                        <th scope="row">{{index + 1}}</th>
                        <td>{{book.title}}</td>
                        <td>{{book.author_name }}</td>
                        <td>{{book.genre }}</td>
                        <td>{{book.published_date }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6 authors-container">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Bio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(author,index) in authors" :key="author.id">
                            <th scope="row">{{index + 1}}</th>
                            <td>{{author.AuthorName}}</td>
                            <td>{{author.AuthorBio }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<style>
.books-container, .author-container {
   
}
</style>