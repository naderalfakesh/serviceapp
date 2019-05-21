<template>
<div>
    <My-header title='Contact'></My-header>
    <div class="container card">
      <div class="card">
        <button type="button" name="button" class="btn btn-primary"
        data-toggle="modal" data-target="#addContact" @click="fetchCompanies()">Add new Contact</button>
      </div>
        <table class="table  ">
            <thead>
                <th>#</th>
                <th>Company</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </thead>
            <tbody>
                    <tr v-for="contact in contacts" v-bind:key="contact.id">
                    <td>{{contact.id}}</td>
                    <td>{{contact.company.name}}</td>
                    <td>{{contact.name}}</td>
                    <td>{{contact.email}}</td>
                    <td>{{contact.phone }}</td>
                    <td>
                        <button type="button" class="close" data-dismiss="modal" @click="deleteContact(contact.id)">&times;</button>
                        <router-link :to="{name: 'contactEdit' , params: {contact} }" > <button type="button" class="btn btn-primary" >Edit</button></router-link>
                    </td>
                </tr>

            </tbody>
        </table>
        <nav aria-label="Page navigation ">
            <ul class="pagination justify-content-center">
                <li class="page-item " v-bind:class="[{disabled: !pagination.prev_page_url}]" ><a class="page-link" href="#" @click="fetchContacts(pagination.prev_page_url)" >Previous</a></li>
                <li class="page-item" v-for="(page, index) in pagination.page_links" :key="index"
                  v-bind:class="[{disabled: pagination.current_page == index+1}]"><a class="page-link" href="#" @click="fetchContacts(page)">{{index+1}}  </a></li>
                <li class="page-item" v-bind:class="[{disabled: !pagination.next_page_url}]" ><a class="page-link" href="#" @click="fetchContacts(pagination.next_page_url)" >Next</a></li>
            </ul>
        </nav>
        <!-- add contact Modal -->
        <div class="modal" ref="addContact"
        id="addContact" tabindex="-1" role="dialog"  aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" >Add new contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <form action="" method="post">
                    <div class="form-group">
                      <label for="company">company:</label>
                      <Select name="company_id"  v-model="contact.company_id" @input="updateValue($event.target.value)" class="form-control">
                        <option v-for="company in companies" v-bind:key="company.id" v-bind:value="company.id">{{company.name}}</option>
                      </Select>
                    </div>
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

                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" name="submit" data-dismiss="modal" 
                @click.prevent="addNewContact()" class="btn btn-primary" >Add new contact</button>
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
                contacts: [],
                companies: [],
                contact: {
                     company_id : '',
                     name: '',
                     email: '',
                     phone:''
                },
                pagination: '',
            };
    },
    created() {
    this.fetchContacts();
    },
    methods:{
        fetchContacts(page_url){
        let vm = this;
        page_url = page_url || '/api/contact';
        fetch(page_url )
            .then(res => res.json())
            .then(res => {
                this.contacts = res.data;
                vm.makePagination(res.meta, res.links);
            })
            .catch(err => console.log(err));
        },
        makePagination(meta, links) {
            let page_count = meta.last_page;
            let page_links= Array(page_count);
            for (let index = 0; index < page_links.length; index++) {
                page_links [index] = '/api/contact?page=' + (index+1) ;
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
    deleteContact(id){
        if (confirm('Are you sure')) {
            fetch(`/api/contact/${id}` , {
                method: 'delete' ,
                 headers: { "X-CSRF-Token": this.csrfToken }
            })
            .then(res => res.json())
            .then(data =>{
                this.fetchContacts();
            })
            .catch(err => console.log(err));
        }

    },
    addNewContact(){
          fetch(`/api/contact` , {
              method: 'post' ,
               headers: { "X-CSRF-Token": this.csrfToken,'content-type': 'application/json'},
               body: JSON.stringify(this.contact),
          })
          .then(res => res.json())
          .then(data =>{
            this.fetchContacts();
          })
          .catch(err => console.log(err));
    },
    fetchCompanies(){
        const page_url = '/api/company/all';
        fetch(page_url )
            .then(res => res.json())
            .then(res => {
                this.companies = res.data;
            })
            .catch(err => console.log(err));
        },
        updateValue(value) {
                this.contact.company_id=value;
                console.log(this.contact.company_id);
            }   




    }
}
</script>

<style>

</style>
