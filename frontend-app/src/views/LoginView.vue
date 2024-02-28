<template>
    <div class="form-body">
      <form @submit.prevent="handleSubmit">
        <div class="form-outline mb-4 text-center">
          <span>管理者ロページ</span>
        </div>
        <div class="form-outline mb-4">
          <input type="email" v-model="email" id="formEmail" class="form-control" placeholder="メールアドレス@example.com" required />
        </div>
        <div class="form-outline mb-4">
          <input type="password" v-model="password" id="formPassword" class="form-control" placeholder="パスワード" required />
        </div>
        <div class="form-outline mb-4" v-if="error"><p class="text-danger">{{ error }}</p></div>
        <div class="form-outline mb-4" v-if="success"><p class="text-success">{{ success }}</p></div>
        <button type="submit" class="btn btn-primary btn-block mb-4">ログイン</button>
      </form>
    </div>
  </template>
  
  <style>
  .form-body {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
  </style>
  
  <script>
  import axios from 'axios';

  export default {
    name: 'LoginForm',
    data() {
      return {
        email: '',
        password: '',
        error: null,
        success: null,
      };
    },
    methods: {
      async handleSubmit() {
        this.error='';
        this.success='';
        try {
          const response = await axios.post('http://127.0.0.1:8000/api/login', {
            email: this.email,
            password: this.password,
          });
  
          if (response.status !== 200) {
            this.error = 'Login failed (status code: ${response.status})';
            return;
          }
          if (response.status === 422) {
            this.error = 'Validation error: ' + response.data.message; // Assuming a message is provided by the backend
            return;
          }
  
          const { access_token } = response.data;
        
          localStorage.setItem('token', access_token);
          this.success = 'Login successful!';
          console.log('Login successful! Access token:', access_token);
          this.$router.push({ name: 'home' });
        } catch (error) {
          this.error = 'Login Failed';
          console.error(error);
        }
      },
    },
  };
  </script>
  