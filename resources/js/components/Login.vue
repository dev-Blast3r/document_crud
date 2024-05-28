<template>
  <div class="p-6">
    <h1 class="text-3xl font-bold mb-6">Login</h1>
    <form @submit.prevent="login" class="max-w-md mx-auto">
      <input type="email" v-model="email" placeholder="Email" class="border border-gray-300 rounded-md px-3 py-2 w-full mb-4 focus:outline-none focus:border-blue-500" />
      <input type="password" v-model="password" placeholder="Password" class="border border-gray-300 rounded-md px-3 py-2 w-full mb-4 focus:outline-none focus:border-blue-500" />
      <button type="submit" class="bg-blue-500 text-black py-2 px-4 rounded-md hover:bg-blue-600 transition-colors">Login</button>
    </form>
  </div>
</template>


<script>
import axios from 'axios';

export default {
    data() {
        return {
            email: '',
            password: '',
        };
    },
    methods: {
        login() {
            axios.post('/api/login', {
                email: this.email,
                password: this.password,
            }).then(response => {
                localStorage.setItem('token', response.data.token);
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + response.data.token;
                this.$router.push('/');
            }).catch(error => {
                console.error('Login failed:', error);
            });
        },
    },
};
</script>