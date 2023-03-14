<template>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
    <!-- = = = = = = = =  =  =[COMPONENT][Card:List]  -->
<card-cp title="List of brands">

    <template slot="content">
     <table-cp :dbdatas="brandsdata"
               :titles="{
               id:{title:'ID', typer:'id'},
               name:{title:'Name', typer:'text'},
               image:{title:'Image', typer:'image'},
               created_at:{title:'Created', typer:'date'},
                config:{title:'Operations', amountcolls: 1 },
               }"
     ></table-cp>
      </template>



    </card-cp>
<!-- = = = = = = = =  =  = [End of Card:List] = -->

</div></div></div>

</template>
<script>
 export default {
     computed: {
            token() {

                 let token = document.cookie.split(';').find(ind => {
                    return ind.includes('token=')
                })

                token = token.split('=')[1]
                token = 'Bearer ' + token

                return token
            }
        },
        data() {
            return {
                urlBase: 'http://localhost:8000/api/v1/brand',
                transactStatus: '',
                transactDetails: {},
                brandsdata:[]
            }
        } ,
     methods:{

          loadList() {
                let config = {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                axios.get(this.urlBase, config)
                    .then(response => {
                        this.brandsdata = response.data
                        //console.log(this.brands)
                    })
                    .catch(errors => {
                        console.log(errors)
                    })
            }
     },
      mounted() {
            this.loadList()
        }
 }
 </script>
