<template>
    <header>
        <div class="wrapper">
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand"> <RouterLink to="/">Home</RouterLink></a>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <RouterLink :to="{name: 'AuthorIndex'}" class="nav-link">Authors</RouterLink>
                            </li>
                            <li class="nav-item">
                                <RouterLink :to="{name:'BookIndex'}" class="nav-link">Books</RouterLink>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex">
                        <ul class="navbar-nav">
                            <li class="navbar-item">
                                <a class="nav-link">logout</a>
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
</script>