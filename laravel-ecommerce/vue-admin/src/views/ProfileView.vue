<script setup>
import { onMounted } from 'vue'
import useProfile from '@/composables/profile'

const { profile, getProfile, updateProfile, deleteProfile } = useProfile()
onMounted(() => getOrders())
</script>