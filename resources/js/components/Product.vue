<template>
  <div>
      <h1>
        vue product online {{ product }}
      </h1>
  </div>
</template>

<script>
export default {
  data() {
    return {
      product: [],
    }
  },
  methods: {
    getProduct() {
      axios.get('/products/{id}')
        .then((response) => {
          this.product = response.data;
        })
    }
  }
}
</script>

<style>

</style>