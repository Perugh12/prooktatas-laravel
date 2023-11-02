import { ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

export default function useOrders() {

    const profile = ref([])
    const errors = ref([])
    const router = ref()

    const getProfile = async () => {
        const response = await axios.get('/profile')
        profile.value = response.data.data
    }

    const updateProfile = async () => {
        try {
            await axios.patch('/profile', profile.value)
        } catch (error) {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors
            }
        }

        await router.push({ name: 'profile' })
    }

    const deleteProfile = async () => {
        if (!confirm('Are you sure?')) return
        await axios.delete('/profile')
        await axios.get('/logout')
        localStorage.removeItem('token')
        await router.push({ name: 'login' })
    }

    return {
        profile,
        errors,
        getProfile,
        updateProfile,
        deleteProfile
    }
}