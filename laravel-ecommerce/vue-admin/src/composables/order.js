import axios from 'axios'
import { ref } from 'vue'

export default function useOrders() {

    const orders = ref([])
    const order = ref([])

    const getOrders = async () => {
        const response = await axios.get('/orders')
        orders.value = response.data.data
    }

    return {

    }
}