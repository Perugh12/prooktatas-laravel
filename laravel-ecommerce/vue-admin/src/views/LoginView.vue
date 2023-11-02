<template>
  <div class="relative flex flex-col items-center justify-center min-h-screen">
    <div class="w-full p-6 shadow bg-slate-800 lg:max-w-md">
      <h1 class="text-3xl font-semibold text-center text-white">
        Belépés
      </h1>
      <form @submit.prevent="submit">
        <div class="mb-6">
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email cím</label>
          <input type="email" id="email" name="email" v-model="email"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="admin@email.com" required />
        </div>
        <div class="mb-6">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jelszó</label>
          <input type="password" id="password" name="password" v-model="password"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            required />
        </div>
        <div class="mb-6">
          <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Belépés
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import axios from 'axios'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const email = ref('admin@email.com')
const password = ref('aA123456')
const submit = async () => {
  const response = await axios.get('/login', {
    params: {
      email: email.value,
      password: password.value
    }
  }).catch(error => {
    if (error.response.status === 401) {
      alert('Hibás email cím vagy jelszó!')
    }
  })

  localStorage.setItem('token', response.data.data.token)
  await router.push({ name: 'dashboard' })
}

</script>