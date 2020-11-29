<template>
  <div class="grid-foundation">
      <section>
        <label for="product">Produkta nosaukums:</label>
            <input v-model="product.title" type="text" name="title" id="title">
       
        <label for="mainCategory">Produkta kategorija:</label>
            <select v-model="product.mainCategory" name="category" id="category">
                <option
                    :key="index"
                    v-for="(category, index) in Object.keys(categories)"
                >{{ category }}</option>
            </select>
       
        <label for="subcategories">Subkategorija:</label>
            <select v-model="product.subcategory" name="subcategories" id="subcategories">
                <option
                    :key="index"
                    v-for="(sub, index) in categories[product.mainCategory]"
                >{{ sub }}</option>    
            </select>
       
        <label for="description">Apraksts:</label>
            <textarea v-model="product.description" name="description" id="description"></textarea>
       
        <label for="new" class="">Atzīmēt kā jaunumu:</label>
            <input v-model="product.new" type="checkbox" name="new" id="new" class="">
      </section>
      <!-- Do I need to build a preview? Or would that just be showing off with Vue? -->
      <section>
        <label>Produkta tipi:</label>
            <button @click="addType">Pievienot tipu (materiālu)</button>
            <div
                :key="index"
                v-for="(type, index) in product.types"
            >
            <label>Tipa:</label>
                <input v-model="type.typeName" type="text">
            <label>Cena:</label>
                <input v-model="type.typePrice" type="number">    
            <label>Variācijas</label>
                <input v-model="type.typeSecondary" @keyup="type.typeSecondary = type.typeSecondary.split(',')" type="text">
            <i class="delete">&times</i>
            </div>
            <br> <br> <br> <br>
      </section>

      <section class="toggle-box">
            <label for="price">Base price:</label>
                <input v-model="product.base_price" type="number" name="price" id="price">
            <label for="sale-price">Atlaides cena:</label>
                <input v-model="product.sale_price" type="number" name="sale-price" id="sale-price">
            <input v-model="on_sale" type="checkbox" id="switch" /><label for="switch">Toggle</label>
          <!-- prices, sale prices, sale y/n, sale-from/to -->
      </section>

      <section>
          <label>Produkta izmēri:</label>
            <button @click="addSize">Pievienot izmēru</button>
            <i @click="addSizeClothing" class="btn-sec">Pievienot drēbju izmērus</i>
            <div
                :key="index"
                v-for="(size, index) in product.sizes"
            >
            <label>Izmērs:</label>
                <input v-model="size.size" type="text">
            <label>Cena</label>
                <input v-model="size.sizePrice" type="number">
            <i class="delete">&times</i>
            </div>
      </section>
      
      <section>{{ product }}</section>
  </div>
</template>

<script>
export default {
    data() {
        return {
            mPrice: "",
            materialInput: "",
            clean: [],
            product: {
                title: "",
                mainCategory: "",
                subcategory: "",
                description: "",
                new: "",
                base_price: "",
                sale_price: "",
                on_sale: "",
                types: [],
                sizes: [],
                taggs: [],
            },
            categories: {
                Drēbes: ['Krekli', 'Džemperi', 'Jakas', 'Kleitas', 'Cepures', 'Šalles', 'Bez apdrukas'],
                Uzlīmes: ['Auto', 'Lieldienu', '', '', '', '',],
                Termouzlīmes: [],
                Tetovējumi: [],
            }
        }
    },
    computed: {
        // output a table of prices
    },
    methods: {
        addType() {
            const newType = {
                typeName: "asd",
                typePrice: 0,
                typeSecondary: [],
            }
            this.product.types.push(newType)
        },
        addSize() {
            const newSize = {
                size: '',
                sizePrice: 0,
            }
            this.product.sizes.push(newSize)
        },
        addSizeClothing() {
            const newSizeS = {
                size: 's',
                sizePrice: 1
            }
        }
    }
}
</script>

<style lang="sass" scoped>

    .grid-foundation    
        display: grid
        grid-template-columns: 1fr 1.5fr
        grid-gap: 1rem
        margin: 3rem
        section
            display: flex
            flex-direction: column

    button
        padding: .25rem 1rem
        background: #c0c0c0
        border-radius: 8px

    .btn-sec, .delete
        display: inline-block
        font-style: normal
        padding: .25rem .6rem
        margin: 0 1rem
        background: lightblue
        border-radius: 8px
        cursor: pointer

    .delete
        font-weight: 900
        padding: 0rem .3rem
        background: red 
        border-radius: 0%


    // make each section into a window (if the contents go over then resort to scrolling instead of expanding the section)
    // add a checkbox which determines weather prices are increased by adding or my multiplying (for clothes by adding since a larger size of clothing item will not increase expenses on material but for stickers by multiplying since a larger size of a more expensive type will result in higher expenses)
        
</style>