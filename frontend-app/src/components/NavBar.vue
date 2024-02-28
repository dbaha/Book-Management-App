<template>
    <header>
        <div class="wrapper">
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand"> <RouterLink to="/">ホーム</RouterLink></a>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <RouterLink :to="{name: 'AuthorIndex'}" class="nav-link">著作者</RouterLink>
                            </li>
                            <li class="nav-item">
                                <RouterLink :to="{name:'BookIndex'}" class="nav-link">書籍</RouterLink>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex">
                        <ul class="navbar-nav">
                            <li class="navbar-item">
                                <RouterLink :to="{name:'login'}" class="nav-link" @click.prevent="logout">ログアウト</RouterLink>
                            </li>
                        </ul>
                    </div>    
                </div>
            </nav>
        </div>
    </header>
</template>
<script>
import { RouterLink} from 'vue-router'
import axios from 'axios';

export default{
    methods:{
        async logout(){
            const token=localStorage.getItem('token');
            console.log(token);
            try{
                const response = await axios.post('http://127.0.0.1:8000/api/logout',null,{
                    headers: {
                    Authorization: `Bearer ${token}`
                    }
                });
                if (response.status === 200 ) {
                    localStorage.removeItem('token');
                    //this.$router.push({ name: 'login' });
                } else {
                    //failed connection
                }  
                console.log('token after logout:' +localStorage.getItem('token'));
            }catch(error){
                console.log(error.response);
            }

        }
    }
};

</script>