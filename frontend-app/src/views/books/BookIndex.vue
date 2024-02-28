<script setup>
    import { onMounted } from 'vue';
    import { RouterLink } from 'vue-router';
    import NavBar from '../../components/NavBar.vue';
    import dataBooks from '@/composable/books.js'

    const {books,getBooks,destroyBook}=dataBooks();
    onMounted(()=>{
        getBooks();
    });
</script>
<template>
    <NavBar />
    <div class="container-md">
        <div class="position-relative">
            <div class="position-absolute top-0 end-0">
                <RouterLink :to="{name: 'BookCreate'}" class="btn btn-success">登録</RouterLink>
            </div>
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">書名</th>
                    <th scope="col">著作者</th>
                    <th scope="col">ジャンル</th>
                    <th scope="col">発行日</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(book,index) in books" :key="book.id">
                <th scope="row">{{index + 1}}</th>
                <td>{{book.title}}</td>
                <td>{{book.author_name }}</td>
                <td>{{book.genre }}</td>
                <td>{{book.published_date }}</td>
                <td>
                    <div class="row">
                    <RouterLink :to="{name: 'BookEdit', params:{id: book.id}}" class="btn btn-primary col mx-2 ">編集</RouterLink>
                    <button class="btn btn-danger col mx-2" @click="destroyBook(book.id)"> 削除 </button>
                    </div>
                </td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
</template>