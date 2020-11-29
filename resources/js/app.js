import { createApp } from 'vue';
import Example from './components/Example.vue';
import App from './components/App.vue';
import Product from './components/Product.vue';

const app = createApp(App)
app.component('hello-world', Example)
app.mount("#app")

const product = createApp(Product)
product.mount("product")
// const product = createApp(Product)
// product.component('',)
// product.mount("#product")
// The problem with this approach is that I'm making the component available 
// everywhere so it's being loaded everywhere even though I won't use it.

require('./bootstrap');