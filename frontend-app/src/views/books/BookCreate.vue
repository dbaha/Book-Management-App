<script setup>
    import NavBar from '@/components/NavBar.vue';
    import {reactive} from 'vue';
    import dataAuthors from '@/composable/authors';
    import dataBooks from '@/composable/books';
    import { onMounted } from 'vue';

    const {authors, getAuthors} = dataAuthors();
    onMounted(()=>getAuthors());
    const {storeBook, errors} = dataBooks();
    const form =reactive({
        title:"",
        author_id:"",
        genre:"",
        published_date:""
    });
</script>
<template>
    <NavBar />
    <div class="container-sm middle-top">
        <form @submit.prevent="storeBook(form)">
            <div class="mb-3">
                <label for="title" class="form-label">書名</label>
                <input type="text" class="form-control" id="title" v-model="form.title">
            </div>
            <div v-if="errors.title" class="mb-3"><a class="text-danger">{{ errors.title[0] }}</a></div>
            <div class="mb-3">
                <label for="authorname" class="form-label">著作者</label>
                <select class="form-select" aria-label="authorname" v-model="form.author_id">
                    <option v-for="(author) in authors" :key="author.id" :value="author.id">{{ author.AuthorName }}</option>
                </select> 
            </div>
            <div v-if="errors.author_id" class="mb-3"><a class="text-danger">{{ errors.author_id[0] }}</a></div>
            <div class="mb-3">
                <label for="genre" class="form-label">ジャンル</label>
                <input type="text" class="form-control" id="bio" v-model="form.genre">
            </div>
            <div v-if="errors.genre" class="mb-3"><a class="text-danger">{{ errors.genre[0] }}</a></div>
            <div class="mb-3">
                <label for="published" class="form-label">発行日</label>
                <input type="date" id="datepicker" class="form-control" v-model="form.published_date" />
            </div>
            <div v-if="errors.published_date" class="mb-3"><a class="text-danger">{{ errors.published_date[0] }}</a></div>
            <button type="submit" class="btn btn-primary">登録</button>
        </form>
    </div>    
</template>