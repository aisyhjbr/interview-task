<template>
<div class="container mt-4">
    <h1>Products</h1>
    <a href="/fetch" class="btn btn-primary mb-3">Fetch & Save Data</a>

    <div v-if="products.length" class="row">
        <div v-for="product in products" :key="product.id" class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">
                    {{ product.name }} <span class="badge bg-secondary">{{ product.type }}</span>
                </div>
                <div class="card-body">
                    <p><strong>PPU:</strong> {{ product.ppu }}</p>
                    <p><strong>Batters:</strong></p>
                    <ul>
                        <li v-for="b in product.batters" :key="b.id">{{ b.type }}</li>
                    </ul>
                    <p><strong>Toppings:</strong></p>
                    <ul>
                        <li v-for="t in product.toppings" :key="t.id">{{ t.type }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const products = ref([])

onMounted(() => {
    axios.get('/')
        .then(res => products.value = res.data.products)
        .catch(console.error)
})
</script>
