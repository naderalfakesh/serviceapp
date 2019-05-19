<template>
<div>
    <My-header title='Company'></My-header>
    <div class="container card">
      <div class="card">
        <button type="button" name="button" class="btn btn-primary"
        data-toggle="modal" data-target="#addCompany">Add new Company</button>
      </div>
        <table class="table table-responsive ">
            <thead>
                <th>#</th>
                <th>name</th>
                <th>type</th>
                <th>email</th>
                <th>website</th>
                <th>phone</th>
                <th>taxAdmin</th>
                <th>taxNumber</th>
                <th>address</th>
                <th>Actions</th>
            </thead>
            <tbody>
                    <tr v-for="company in companies" v-bind:key="company.id">
                    <td>{{company.id}}</td>
                    <td>{{company.name}}</td>
                    <td>{{company.type}}</td>
                    <td>{{company.email}}</td>
                    <td>{{company.website}}</td>
                    <td>{{company.phone }}</td>
                    <td>{{company.taxAdmin}}</td>
                    <td>{{company.taxNumber}}</td>
                    <td>{{company.address}}</td>
                    <td>
                        <button type="button" class="close" data-dismiss="modal" @click="deleteCompany(company.id)">&times;</button>
                        <router-link :to="{name: 'companyEdit' , params: {company} }" > <button type="button" class="btn btn-primary" >Edit</button></router-link>
                    </td>
                </tr>

            </tbody>
        </table>
        <nav aria-label="Page navigation ">
            <ul class="pagination justify-content-center">
                <li class="page-item " v-bind:class="[{disabled: !pagination.prev_page_url}]" ><a class="page-link" href="#" @click="fetchCompanies(pagination.prev_page_url)" >Previous</a></li>
                <li class="page-item" v-for="(page, index) in pagination.page_links" :key="index"
                  v-bind:class="[{disabled: pagination.current_page == index+1}]"><a class="page-link" href="#" @click="fetchCompanies(page)">{{index+1}}  </a></li>
                <li class="page-item" v-bind:class="[{disabled: !pagination.next_page_url}]" ><a class="page-link" href="#" @click="fetchCompanies(pagination.next_page_url)" >Next</a></li>
            </ul>
        </nav>
        <!-- add company Modal -->
        <div class="modal" ref="addCompany"
        id="addCompany" tabindex="-1" role="dialog"  aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" >Add new company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <form action="" method="post">
                    <div class="form-group">
                      <label for="type">company type:</label>
                        <select name="type" id="" class="form-control" v-model="company.type">
                            <option value="WEG Branch" >WEG Branch</option>
                            <option value="Customer" >Customer</option>
                            <option value="Requesting company" >Requesting company</option>
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
                        <label for=" ">website: </label>
                        <input type="text" class="form-control" v-model="company.website">
                    </div>
                    <div class="form-group">
                        <label for=" ">Phone: </label>
                        <input type="text"  class="form-control" v-model="company.phone">
                    </div>
                    <div class="form-group">
                        <label for=" ">Tax Admin: </label>
                        <input type="text"  class="form-control" v-model="company.taxAdmin">
                    </div>
                    <div class="form-group">
                        <label for=" ">Tax Number: </label>
                        <input type="text"  class="form-control" v-model="company.taxNumber">
                    </div>
                    <div class="form-group">
                        <label for=" ">Address: </label>
                        <input type="text"  class="form-control" v-model="company.address">
                    </div>

                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" name="submit" data-dismiss="modal" 
                @click.prevent="addNewCompany()" class="btn btn-primary" >Add new company</button>
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
                companies: [],
                company: {
                    // id : ''
                },
                pagination: '',
            };
    },
    created() {
    this.fetchCompanies();
    },
    methods:{
        fetchCompanies(page_url){
        let vm = this;
        page_url = page_url || '/api/company';
        fetch(page_url )
            .then(res => res.json())
            .then(res => {
                this.companies = res.data;
                vm.makePagination(res.meta, res.links);
            })
            .catch(err => console.log(err));
        },
        makePagination(meta, links) {
            let page_count = meta.last_page;
            let page_links= Array(page_count);
            for (let index = 0; index < page_links.length; index++) {
                page_links [index] = '/api/company?page=' + (index+1) ;
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
    deleteCompany(id){
        if (confirm('Are you sure')) {
            fetch(`/api/company/${id}` , {
                method: 'delete' ,
                 headers: { "X-CSRF-Token": this.csrfToken }
            })
            .then(res => res.json())
            .then(data =>{
                this.fetchCompanies();
            })
            .catch(err => console.log(err));
        }

    },
    addNewCompany(){
          fetch(`/api/company` , {
              method: 'post' ,
               headers: { "X-CSRF-Token": this.csrfToken,'content-type': 'application/json'},
               body: JSON.stringify(this.company),
          })
          .then(res => res.json())
          .then(data =>{
            this.fetchCompanies();
          })
          .catch(err => console.log(err));


    },




    }
}
</script>

<style>

</style>
