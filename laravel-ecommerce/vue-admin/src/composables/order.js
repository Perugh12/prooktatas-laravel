import { ref } from 'vue'
import axios from 'axios'

export default function useOrders() {

    const orders = ref([])
    const orderLoading = ref(false)

    const getOrders = async () => {
        orderLoading.value = true
        const response = await axios.get('/orders')
        orders.value = response.data.data
        orderLoading.value = false
    }

    return {
        orderLoading,
        orders,
        getOrders
    }
}