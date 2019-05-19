<template>
    <div>
      <My-header title='Company Edit'></My-header>
        <form action="" method="post">
            <div class="form-group">
              <label for="type">Company type:</label>
                <select name="type" id="" class="form-control" v-model="company.type">
                    <option value="WEG Branch" :selected="company.type=='WEG Branch' ? true : false">WEG Branch</option>
                    <option value="Customer" :selected="company.type=='Customer' ? true : false">Customer</option>
                    <option value="Requesting company" :selected="company.type=='Requesting company' ? true : false">Requesting company</option>
                </select>
            </div>
            <div class="form-group">
              <label for="name">Name:</label>
                <input type="text" name="name" class="form-control"  v-model="company.name">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" class="form-control" v-model="company.email">
            </div>
            <div class="form-group">
                <label for=" ">Website: </label>
                <input type="text" class="form-control" v-model="company.website">
            </div>
            <div class="form-group">
                <label for=" ">Phone: </label>
                <input type="text"  class="form-control" v-model="company.phone">
            </div>
            <div class="form-group">
                <label for=" ">Tax Adminstration: </label>
                <input type="text"  class="form-control" v-model="company.taxAdmin">
            </div>
            <div class="form-group">
                <label for=" ">Tax number: </label>
                <input type="text"  class="form-control" v-model="company.taxNumber">
            </div>
            <div class="form-group">
                <label for=" ">Address: </label>
                <input type="text"  class="form-control" v-model="company.address">
            </div>
            <div class="form-group">
                <button type="button" name="submit" @click.stop.prevent="updateCompany(company.id)" class="btn btn-primary">Save</button>
            </div>
        </form>

    </div>
</template>

<script>
export default {
    props: ['company'],
    data: function () {
      return {
        csrfToken: document.querySelector(`meta[name="csrf-token"]`).getAttribute(`content`),
      }
    },
    methods:{
      updateCompany: function(id){
          if (confirm('Are you sure')) {
              fetch(`/api/company/${id}` , {
                  method: 'put' ,
                   headers: { "X-CSRF-Token": this.csrfToken,'content-type': 'application/json'},
                   body: JSON.stringify(this.company),
              })
              .then(res => res.json())
              .then(data =>{
                  this.$router.push({name: "company"});
              })
              .catch(err => console.log(err));
          }

      }
    },

}
</script>
