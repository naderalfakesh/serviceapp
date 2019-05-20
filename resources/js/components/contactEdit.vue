<template>
    <div>
      <My-header title='Contact Edit'></My-header>
        <form action="" method="post">
            <div class="form-group">
              <label for="name">Name:</label>
                <input type="text" name="name" class="form-control"  v-model="contact.name">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" class="form-control" v-model="contact.email">
            </div>
            <div class="form-group">
                <label for=" ">Phone: </label>
                <input type="text"  class="form-control" v-model="contact.phone">
            </div>
            <div class="form-group">
                <button type="button" name="submit" @click.stop.prevent="updateContact(contact.id)" class="btn btn-primary">Save</button>
            </div>
        </form>

    </div>
</template>

<script>
export default {
    props: ['contact'],
    data: function () {
      return {
        csrfToken: document.querySelector(`meta[name="csrf-token"]`).getAttribute(`content`),
      }
    },
    methods:{
      updateContact: function(id){
          if (confirm('Are you sure')) {
              fetch(`/api/contact/${id}` , {
                  method: 'put' ,
                   headers: { "X-CSRF-Token": this.csrfToken,'content-type': 'application/json'},
                   body: JSON.stringify(this.contact),
              })
              .then(res => res.json())
              .then(data =>{
                  this.$router.push({name: "contact"});
              })
              .catch(err => console.log(err));
          }

      }
    },

}
</script>
