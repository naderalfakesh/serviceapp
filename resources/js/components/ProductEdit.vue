<template>
    <div>
      <My-header title='Product Edit'></My-header>
        <form action="" method="post">
            <div class="form-group">
              <label for="type">Product type:</label>
                <select name="type" id="" class="form-control" v-model="product.type">
                    <option value="Motor" :selected="product.type=='Motor' ? true : false">Motor</option>
                    <option value="VFD" :selected="product.type=='VFD' ? true : false">VFD</option>
                    <option value="Gearbox" :selected="product.type=='Gearbox' ? true : false">Gearbox</option>
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
            <div class="form-group">
                <button type="button" name="submit" @click.stop.prevent="updateProduct(product.id)" class="btn btn-primary">Save</button>
            </div>
        </form>

    </div>
</template>

<script>
export default {
    props: ['product'],
    data: function () {
      return {
        csrfToken: document.querySelector(`meta[name="csrf-token"]`).getAttribute(`content`),
        attributes : JSON.parse(this.product.attributes)
      }
    },
    methods:{
      updateProduct: function(id){
        // console.log(JSON.parse(this.product.attributes));
        //this.product.attributes = JSON.stringify(this.attributes);
          if (confirm('Are you sure')) {
            this.product.attributes = JSON.stringify(this.attributes);
              fetch(`/api/product/${id}` , {
                  method: 'put' ,
                   headers: { "X-CSRF-Token": this.csrfToken,'content-type': 'application/json'},
                   body: JSON.stringify(this.product),
              })
              .then(res => res.json())
              .then(data =>{
                  this.$router.push({name: "product"});
              })
              .catch(err => console.log(err));
          }

      }
    },

}
</script>
