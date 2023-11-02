import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'

axios.defaults.baseURL = 'http://localhost:8000/api/admin'
axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`

const app = createApp(App)

app.use(router)

app.mount('#app')
