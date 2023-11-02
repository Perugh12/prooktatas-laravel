<template>
  <header v-if="notLoggedIn()">
    <div class="header-wrapper">
      <NavbarComponent />
    </div>
  </header>

  <div class="mx-4">
    <RouterView />
  </div>
</template>

<script setup>
import { onMounted } from 'vue'
import { RouterView, useRouter } from 'vue-router'
import NavbarComponent from '@/components/NavbarComponent.vue'

const router = useRouter()

const notLoggedIn = () => {
  if (!localStorage.getItem('token')) {
    return false;
  }

  return true;
}

// redirect to login if not logged in
onMounted(() => {
  if (!localStorage.getItem('token')) {
    router.push({ name: 'login' })
  }
})

</script>

<style>
body {
  --tw-bg-opacity: 1;
  background-color: rgba(17 24 39 / var(--tw-bg-opacity));
}
</style>
