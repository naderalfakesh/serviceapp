<template >
    <div>
      <My-header title='Products'></My-header>
    <div class="container card">
      <div class="card">
        <button type="button" name="button" class="btn btn-primary"
        data-toggle="modal" data-target="#addProduct">Add new product</button>
      </div>
        <table class="table ">
            <thead>
                <th>#</th>
                <th>Type</th>
                <th>Material number</th>
                <th>S.N</th>
                <th>Power</th>
                <th>created_at</th>
                <th>Action</th>
            </thead>
            <tbody>
                    <tr v-for="product in products" v-bind:key="product.id">
                    <td>{{product.id}}</td>
                    <td>{{product.type}}</td>
                    <td>{{product.materialNumber}}</td>
                    <td>{{product.serialNumber}}</td>
                    <td>{{JSON.parse(product.attributes).power }}</td>
                    <td>{{product.created_at}}</td>
                    <td>
                        <button type="button" class="close" data-dismiss="modal" @click="deleteProduct(product.id)">&times;</button>
                        <router-link :to="{name: 'productEdit' , params: {product} }" > <button type="button" class="btn btn-primary" >Edit</button></router-link>
                    </td>
                </tr>

            </tbody>
        </table>
        <nav aria-label="Page navigation ">
            <ul class="pagination justify-content-center">
                <li class="page-item " v-bind:class="[{disabled: !pagination.prev_page_url}]" ><a class="page-link" href="#" @click="fetchProducts(pagination.prev_page_url)" >Previous</a></li>
                <li class="page-item" v-for="(page, index) in pagination.page_links" :key="index"
                  v-bind:class="[{disabled: pagination.current_page == index+1}]"><a class="page-link" href="#" @click="fetchProducts(page)">{{index+1}}  </a></li>
                <li class="page-item" v-bind:class="[{disabled: !pagination.next_page_url}]" ><a class="page-link" href="#" @click="fetchProducts(pagination.next_page_url)" >Next</a></li>
            </ul>
        </nav>
        <!-- add product Modal -->
        <div class="modal" ref="addProduct"
        id="addProduct" tabindex="-1" role="dialog"  aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" >Add new product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <form action="" method="post">
                    <div class="form-group">
                      <label for="type">Product type:</label>
                        <select name="type" id="" class="form-control" v-model="product.type">
                            <option value="Motor" >Motor</option>
                            <option value="VFD" >VFD</option>
                            <option value="Gearbox" >Gearbox</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="materialNumber">Material number:</label>
                        <input type="text" name="materialNumber" class="form-control"  v-model="product.materialNumber">
                    </div>
                    <div class="form-group">
                        <label for="serialNumber">Serial number:</label>
                        <input type="text" name="serialNumber" class="form-control" v-model="product.serialNumber">
                    </div>
                    <div class="form-group">
                        <label for=" ">Power: </label>
                        <input type="text" class="form-control" v-model="attributes.power">
                    </div>
                    <div class="form-group">
                        <label for=" ">Speed: </label>
                        <input type="text"  class="form-control" v-model="attributes.speed">
                    </div>
                    <div class="form-group">
                        <label for=" ">Frame: </label>
                        <input type="text"  class="form-control" v-model="attributes.frame">
                    </div>

                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" name="submit" data-dismiss="modal" 
                @click.prevent="addNewProduct()" class="btn btn-primary" >Add new product</button>
              </div>
            </div>
          </div>
        </div>

     </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            csrfToken: document.querySelector(`meta[name="csrf-token"]`).getAttribute(`content`),
            products: [],
            product: {
                id : '',
                type : '',
                materialNumber : '',
                serialNumber : '',
                attributes : {},
            },
            attributes: {},
            product_id: '',
            pagination: '',
        };
},
// components: {
//     product-edit-component
// },

created() {
    this.fetchProducts();
    // console.log();
},

methods: {
    fetchProducts(page_url){
        //console.log('I am fetching');
        let vm = this;
        page_url = page_url || '/api/product';
        fetch(page_url )
            .then(res => res.json())
            .then(res => {
                this.products = res.data;
                vm.makePagination(res.meta, res.links);
            })
            .catch(err => console.log(err));
    },
    makePagination(meta, links) {
      let page_count = meta.last_page;
      let page_links= Array(page_count);
      for (let index = 0; index < page_links.length; index++) {
          page_links [index] = '/api/product?page=' + (index+1) ;
      }
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev,
        page_links : page_links

      };
      this.pagination = pagination;
    },
    deleteProduct(id){
        if (confirm('Are you sure')) {
            fetch(`/api/product/${id}` , {
                method: 'delete' ,
                 headers: { "X-CSRF-Token": this.csrfToken }
            })
            .then(res => res.json())
            .then(data =>{
                this.fetchProducts();
            })
            .catch(err => console.log(err));
        }

    },
    addNewProduct(){
          this.product.attributes=JSON.stringify(this.attributes);
          fetch(`/api/product` , {
              method: 'post' ,
               headers: { "X-CSRF-Token": this.csrfToken,'content-type': 'application/json'},
               body: JSON.stringify(this.product),
          })
          .then(res => res.json())
          .then(data =>{
            this.fetchProducts();
          })
          .catch(err => console.log(err));


    },



},
mounted() {
            // console.log('Component mounted.')
        }

}
</script>

<style scoped>
tr:hover td{
    color: red;
    text-decoration-line: underline;
    background-color: grey;
}
table .hidden-row{
padding: 0 8px;
}
</style>
