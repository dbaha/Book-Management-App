<script setup>
    import NavBar from '../../components/NavBar.vue';
    import { reactive } from 'vue';
    import dataAuthors from '@/composable/authors';

    const{storeAuthor,errors} = dataAuthors(); 

    const form= reactive({
        name:"",
        bio:""
    });
</script>
<template>
    <NavBar />
    <div class="container-sm middle-top">
        <form @submit.prevent="storeAuthor(form)">
            <div class="mb-3">
                <label for="name" class="form-label">Author Name</label>
                <input type="text" class="form-control" id="name" v-model="form.name">
            </div>
            <div v-if="errors.name" class="mb-3"><a class="text-danger">{{ errors.name[0] }}</a></div>
            <div class="mb-3">
                <label for="bio" class="form-label">Bio</label>
                <input type="text" class="form-control" id="bio" v-model="form.bio">
            </div>
            <div v-if="errors.bio" class="mb-3"><a class="text-danger">{{ errors.bio[0] }}</a></div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>    
</template>
<style>
.middle-top{
    max-width: 500px;
    padding: 15px;
    margin: auto;
}
</style>
    
