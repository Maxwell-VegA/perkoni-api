<template>
  <div class="grid-foundation">
      <section class="toggle-box">
          <!-- ======================================================== -->
          <!-- Product basic properties -->
        <label for="product">Produkta nosaukums:</label>
            <input v-model="product.title" type="text" name="title" id="title">
            <b v-if="errors.title">{{ errors.title }}</b>
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
      </section>
      <section>
          <!-- ======================================================== -->
          <!-- Product types properties-->
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
          <!-- ======================================================== -->
          <!-- Product pricing properties -->
            <label for="price">Base price:</label>
                <input v-model="product.base_price" type="number" name="price" id="price">
            <label for="sale-price">Atlaides cena:</label>
                <input v-model="product.sale_price" type="number" name="sale-price" id="sale-price">
            <label>On sale:</label>
                <input v-model="product.on_sale" type="checkbox" id="switch2" class="switch-i"><label id="switch2" for="switch2" class="switch">Toggle</label>
            <label>Calculation mode:</label>
                <input v-model="product.operator" type="checkbox" id="switch3" class="switch-i"><label id="switch3" for="switch3" class="switch">Toggle</label>
            <table>
                <tr>
                    <th v-if="product.operator">addition</th>
                    <th v-else>multiplication</th>
                    <th :key="i" v-for="(size, i) in product.sizes">{{ size.size }}</th>
                </tr>
                <th>
                    <tr :key="i" v-for="(type, i) in product.types">{{ type.typeName }}</tr>
                </th>
                <th :key="i" v-for="(size, i) in product.sizes">
                    <div v-if="product.operator">
                        <tr :key="i" v-for="(type, i) in product.types">{{ (parseFloat(product.base_price) + parseFloat(type.typePrice) + parseFloat(size.sizePrice)).toFixed(2) }}</tr>
                    </div>
                    <div v-else>
                        <tr :key="i" v-for="(type, i) in product.types">{{ (parseFloat(product.base_price) + parseFloat(type.typePrice) * parseFloat(size.sizePrice)).toFixed(2) }}</tr>
                        <!-- perhaps I shouldn't be doing all this inline? -->
                    </div>
                </th>
            </table>
            <!-- Factor in sale prices -->
            <!-- Will need to make this whole thing work with floats not just ints -->
          <!-- prices, sale prices, sale y/n, sale-from/to -->
      </section>

      <section>
          <!-- ======================================================== -->
          <!-- Product sizes properties -->
          <label>Produkta izmēri:</label>
            <button @click="addSize">Pievienot izmēru</button>
            <i v-if="product.mainCategory === 'Drēbes'" @click="addSizeClothing" class="btn-sec">Standarta izmēri</i>
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

      <section class="toggle-box">
          <!-- ======================================================== -->
          <!-- Product filter properties -->
          <label for="taggs">Taggs:</label>
            <input v-model="taggsInput" type="text" name="taggs" id="taggs" placeholder="atdali't ar komatu">
            <p>{{ taggs }}</p>
          <div v-if="product.mainCategory === 'Drēbes'">
            <label for="gender">Dzimums:</label>
                <select v-model="product.gender" id="gender">
                    <option value="unisex">Unisex</option>
                    <option value="kids">Kids</option>
                    <option value="men">Men</option>
                    <option value="women">Women</option>
                </select>
          </div>
          <label>Atzīmēt kā jaunumu:</label>
            <input v-model="product.new" type="checkbox" id="switch1"><label id="switch1" for="switch1" class="switch">Toggle</label>
      </section>
      <!-- still need to add a section for images and image descriptions -->
      <section>
          <!-- <button @click="directPublish">Direct Publish</button> -->
            <textarea v-model="jsonInput" name="" id="" cols="1" rows="1"></textarea>
            <button @click="input">Input</button>
          {{ product }}

          <!-- <form action="/api/products" method="POST">
            <input v-model="product.user_id" type="text"    name="user_id">
            <input v-model="product.title" type="text"      name="title">
            <input v-model="product.mainCategory" type="text"      name="mainCategory">
            <input v-model="product.subcategory" type="text"      name="subcategory">
            <input v-model="product.description" type="text"      name="description">
            <input v-model="product.is_new" type="text"      name="is_new">
            <input v-model="product.base_price" type="text"      name="base_price">
            <input v-model="product.sale_price" type="text"      name="sale_price">
            <input v-model="product.on_sale" type="text"      name="on_sale">
            <input v-model="product.types" type="text"      name="types">
            <input v-model="product.operator" type="text"      name="operator">
            <input v-model="product.sizes" type="text"      name="sizes">
            <input v-model="taggs" type="text"      name="taggs">
            <input v-model="product.gender" type="text"      name="gender">
            <button type="submit">Submit form</button>
          </form> -->
          <button @click="directPublish">Direct Publish</button>
          {{ errors }}
      </section>
    <!-- { "title": "The Cool Hoodie", "mainCategory": "Drēbes", "subcategory": "Džemperi", "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. ", "new": false, "base_price": "30", "sale_price": "20", "on_sale": false, "types": [ { "typeName": "basic", "typePrice": 0, "typeSecondary": [ "sarkans", " balts", " peleks" ] }, { "typeName": "extra cool", "typePrice": "5", "typeSecondary": [ "sarkans", " melns", " balts", "" ] } ], "operator": true, "sizes": [ { "size": "S", "sizePrice": "0" }, { "size": "M", "sizePrice": "0" }, { "size": "L", "sizePrice": 3 }, { "size": "XL", "sizePrice": "5" } ], "gender": "genderless", "user_id": "1" } -->
  </div>
</template>
<script>
export default {
    data() {
        return {
            errors: {},
            jsonInput: "",
            mPrice: "",
            clean: [],
            taggsInput: "",
            product: {
                user_id: 1,
                title: "",
                mainCategory: "",
                subcategory: "",
                description: "",
                new: false,
                base_price: "",
                sale_price: "",
                // figure out how to pass these as ints instead of strs
                on_sale: false,
                types: [],
                operator: "addition",
                // something weird with operator starting value
                sizes: [],
                // taggs: [],
                gender: "genderless"
                // likely if the gender is set with the product as clothing then the category changed to something else it doesn't reset to genderless
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
        taggs() {
            var arr = [];
            arr = this.taggsInput.split(',')
            return arr
        },
        productStringified() {
            return JSON.stringify(this.product);
        }
    },
    methods: {
        input() {
            this.product = JSON.parse(this.jsonInput);
        },
        directPublish() {
            axios
                .post('/api/products', {
                    user_id: this.product.user_id,
                    title: this.product.title,
                    mainCategory: this.product.mainCategory,
                    subcategory: this.product.subcategory,
                    description: this.product.description,
                    is_new: this.product.new,
                    base_price: this.product.base_price,
                    sale_price: this.product.sale_price,
                    on_sale: this.product.on_sale,
                    types: this.product.types,
                    operator: this.product.operator,
                    sizes: this.product.sizes,
                    taggs: this.taggs,
                    gender: this.product.gender,
                    // was it not possible to just for loop through this crap?
                })
                .then(res => console.log(res))
                .catch(err => this.errors = err.response.data.errors)
        },
        addType() {
            const newType = {
                typeName: "",
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
                size: 'S',
                sizePrice: 1
            }
            const newSizeM = {
                size: 'M',
                sizePrice: 1
            }
            const newSizeL = {
                size: 'L',
                sizePrice: 3
            }
            const newSizeXL = {
                size: 'XL',
                sizePrice: 3
            }
            this.product.sizes.push(newSizeS, newSizeM, newSizeL, newSizeXL)
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
            // background: lightgray

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