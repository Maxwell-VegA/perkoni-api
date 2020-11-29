<template>
  <div class="ml-32">
      <h1 class="text-4xl font-bold">
        Products
      </h1>
      <br>
      <div v-for="product in products" :key="product.id">
        <div v-if="product.id">
          <div v-if="single">
            <h1>
              {{ product.title }}
            </h1>
            <p>Description: {{ product.description}}</p>
            <span>{{ product.base_price}}$</span>
          </div>

          <div v-else>
          <h2>
            <b>{{ product.title }}</b>#
            {{ product.id }}
          </h2>
          <p>
            {{ product.description }}
          </p>
          <span>
            {{ product.base_price }}$
          </span>
          <button @click="getSingle(product.id)">View Product</button>
          <br>
          <i>
            User id: {{ product.user_id }}
          </i>
          <br>
          <br>
          </div>
        </div>
      </div>
      <ul v-if="!single">
        <li>Page {{ pagination.current_page }} of {{ pagination.last_page }}</li>
        <li :class="[{'bg-red-600': !pagination.prev_page}]" @click="getProducts(pagination.prev_page)">Previous</li>
        <li :class="[{'bg-red-600': !pagination.next_page}]" @click="getProducts(pagination.next_page)">Next</li>
      </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      single: false,
      products: [],
      product: {
        id: '',
        user_id: '',
        title: '',
        base_price: '',
        description: '',
        materials: {},
        sizes: {},
        taggs: {},
        created_at: '',
        updated_at: '',
      },
      product_id: '',
      pagination: {},
    }
  },
  created() {
    this.getProducts();
  },

  methods: {
    getProducts(page_url) {
      let vm = this;
      page_url = page_url || '/api/products'
      axios
        .get(page_url)
        .then(res => {
          // console.log(res.data.links[res.data.links.length - 1]);
          // console.log(res.data.next_page_url);
          this.products = res.data.data;
          this.single = false;
          vm.makePagination(res.data);
        })
        .catch(err => console.log(err))
    },
    makePagination(res) {
      let pagination = {
        current_page: res.current_page,
        last_page: res.last_page,
        next_page: res.next_page_url,
        prev_page: res.prev_page_url,
      }
      this.pagination = pagination;
    },
    getSingle(id){
      let page_url = '/api/products/' + id;
      axios
        .get(page_url)
        .then(res => {
          this.products = res.data;
          this.single = true
          console.log(res.data);
        })
    }
  }
}
</script>

<style>

</style>