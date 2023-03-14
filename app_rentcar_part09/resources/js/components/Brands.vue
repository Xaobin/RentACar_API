<template>
    <div class="container">
    <div class="row justify-content-center">
    <div class="col-md-8">
 <!-- = = = = = = = =  =  =  = = [COMPONENT][Card:Search] -->
    <card-cp title="Search for brands">
    <template slot="content">
     <div class="form-row">
     <div class="col mb-3"> <!-- =[Input:|Brand ID|] -->
     <input-cp title="ID" id="inputId" id-help="idHelp" text-help="Optional, provide the Brand ID">
     <input type="number" class="form-control" id="inputId" aria-describedby="idHelp" placeholder="ID">
     </input-cp>
     </div>
     <div class="col mb-3"> <!-- =[Input:|Brand's name|]-->
     <input-cp title="name of brand" id="inputname" id-help="nameHelp"
        text-help="Optional. Provide the brand's name">
     <input type="text" class="form-control" id="inputname" aria-describedby="nameHelp"
        placeholder="name of brand">
     </input-cp> <!-- = = = = = = = = -->
     </div>
     </div>
    </template>
    <template slot="footer">
    <button type="submit" class="btn btn-primary btn-sm float-right">Search</button>
    </template>
    </card-cp>
 <!-- = = = = = = = =  =  [End of Card:Search] = -->


<!-- = = = = = = = =  =  =[COMPONENT][Card:List]  -->
<card-cp title="List of brands">
   
    <template slot="content">
     <table-cp :dbdatas="brandsdata"
               :titles="{
               id:{title:'ID', typer:'text'},
               name:{title:'Name', typer:'text'},
               image:{title:'Image', typer:'image'},
               created_at:{title:'Created', typer:'date/time'},
               }"
     ></table-cp>
      </template>
   
      <template slot="footer">
      <button type="button" class="btn btn-primary btn-sm float-right"
      data-toggle="modal" data-target="#modalbrand">Add</button>
    </template>
   
    </card-cp>
<!-- = = = = = = = =  =  = [End of Card:List] = -->
    


<!-- = = = = = = = =  =  =[COMPONENT][Modal:Add]-->
    <modal-cp id="modalbrand" title="Add brand">

    <template slot="alerts"> <!-- = =[Alerts] = = -->
        <alert-cp stll="success" :details="transactDetails" title="Registration done successfully"
        v-if="transactStatus == 'added'"></alert-cp>
        <alert-cp stll="danger" :details="transactDetails"
        title="Error when trying to register the brand" v-if="transactStatus == 'error'"></alert-cp>
    </template>

       <template slot="content"> <!-- = =[Input:Name] = = -->
        <div class="form-group">
        <input-cp title="name of brand" id="newName" id-help="newNameHelp"
            text-help="Inform the name of brand">
        <input type="text" class="form-control" id="newName" aria-describedby="newNameHelp"
               placeholder="name of brand" v-model="namebrand">
        </input-cp> {{ namebrand }}
        </div>

         <div class="form-group"> <!-- = =[Input:Image] = = -->
        <input-cp title="Image" id="newImage" id-help="newImageHelp"
        text-help="Select the image in format PNG">
        <input type="file" class="form-control-file" id="newImage" aria-describedby="newImageHelp" placeholder="Select a Image"
        @change="loadImage($event)">
        </input-cp> {{ fileImage }}
        </div>
    </template>

      <template slot="footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" @click="saveh()">save</button>
        </template>
    </modal-cp>
    <!-- = = = = = = = =  =  [End of Modal] -->
   

<!-- = = = = = = = =  =  = [MODAL VIEW BRAND] =  -->
    <modal-cp id="modalBrandView" title="View brand">
    
            <template slot="alerts"></template>
            <template slot="content">
                <input-cp title="ID">
                    <input type="text" class="form-control" :value="$store.state.item.id" disabled>
                </input-cp>

                <input-cp title="Name of brand">
                    <input type="text" class="form-control" :value="$store.state.item.Name" disabled>
                </input-cp>

                <input-cp title="Image">
                    <img :src="'storage/'+$store.state.item.Image" v-if="$store.state.item.Image">
                </input-cp>

                <input-cp title="Created At">
                    <input type="text" class="form-control" :value="$store.state.item.created_at" disabled>
                </input-cp>
            </template>
            <template slot="footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </template>
           
    </modal-cp>
<!-- = = = = = = = =  =  =  =  =  =  =  =  -->

<!-- = = = = = = = =  = [Modal Brand Remove] =  -->
        <modal-cp id="modalBrandRemove" title="Delete brand">
            <template slot=alerts>
                <alert-cp tipo="success" title="Transaction performed with success" :detalhes="$store.state.transact" v-if="$store.state.transact.status == 'success'"></alert-cp>
                <alert-cp tipo="danger" title="error na Transaction" :detalhes="$store.state.transact" v-if="$store.state.transact.status == 'error'"></alert-cp>
            </template>
            <template slot="content" v-if="$store.state.transact.status != 'success'">
                <input-cp title="ID">
                    <input type="text" class="form-control" :value="$store.state.item.id" disabled>
                </input-cp>

                <input-cp title="Name of brand">
                    <input type="text" class="form-control" :value="$store.state.item.Name" disabled>
                </input-cp>
            </template>
            <template slot="footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" @click="deleteh()" v-if="$store.state.transact.status != 'success'">Delete</button>
            </template>
        </modal-cp>
 <!-- = = = = = = = =  =  =  =  =  =  =  =  -->

<!-- = = = = = = = =  =  [Modal Update Brand] =  -->
    <modal-cp id="modalbrandUpdate" title="Update brand">

            <template slot="alerts">
                <alert-cp tipo="success" title="Transaction performed with success" :detalhes="$store.state.transact" v-if="$store.state.transact.status == 'success'"></alert-cp>
                <alert-cp tipo="danger" title="error in Transaction" :detalhes="$store.state.transact" v-if="$store.state.transact.status == 'error'"></alert-cp>
            </template>

            <template slot="content">
                <div class="form-group">
                    <input-cp title="Name of brand" id="UpdateName" id-help="UpdateNameHelp" texto-Help="Inform the Name of brand">
                        <input type="text" class="form-control" id="UpdateName" aria-describedby="UpdateNameHelp" placeholder="Name of brand" v-model="$store.state.item.name">
                    </input-cp>
                </div>

                <div class="form-group">
                    <input-cp title="Image" id="UpdateImage" id-help="UpdateImageHelp" texto-Help="Select  a Image no formato PNG">
                        <input type="file" class="form-control-file" id="UpdateImage" aria-describedby="UpdateImageHelp" placeholder="Select a Image" @change="carregarImage($event)">
                    </input-cp>
                </div>
            </template>

            <template slot="footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click="updateh()">Update</button>
            </template>
        </modal-cp>

<!-- = = = = = = = =  =  =  =  =  =  =  =  -->



</div>
</div>
</div>
<!-- = = = = = = = =  =  =  =  =  =  =  =  -->
</template>
<!-- = = = = = = = =  =  =  =  =  =  =  =  -->

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
                namebrand: '',
                fileImage: [],
                transactStatus: '',              /* ___3___ */
                transactDetails: {},              /* ___4___ */
                brandsdata:[]
            }
        },
 /* . . . . . . . . . . . . . . . . . . . */         
        methods: {
 /* . . . . . . . . . . . . . . . . . . . */            
        updateh() {

        let formData = new FormData();
        formData.append('_method', 'patch')
        formData.append('name', this.$store.state.item.name)

        if(this.fileImage[0]) {
            formData.append('image', this.fileImage[0])
        }

        let url = this.urlBase + '/' + this.$store.state.item.id

        let config = {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }

axios.post(url, formData, config)
    .then(response => {
        this.$store.state.transact.status = 'success'
        this.$store.state.transact.message = 'The register was updated'

        //limpar o campo de seleção de arquivos
        atualizarimage.value = ''
        this.carregarLista()
    })
    .catch(errors => {
        this.$store.state.transact.status = 'error'
        this.$store.state.transact.message = errors.response.data.message
        this.$store.state.transact.dados = errors.response.data.errors
    })
},
 /* . . . . . . . . . . . . . . . . . . . */   
        deleteh() {
                let confirma = confirm('Are you sure to delete the register?')

                if(!confirma) {
                    return false;
                }

                let formData = new FormData();
                formData.append('_method', 'delete')

                let url = this.urlBase + '/' + this.$store.state.item.id

                axios.post(url, formData)
                    .then(response => {                        
                        this.$store.state.transact.status = 'success'
                        this.$store.state.transact.message = response.data.msg
                        this.carregarLista()
                    })
                    .catch(errors => {
                        this.$store.state.transact.status = 'erro'
                        this.$store.state.transact.message = errors.response.data.erro
                    })

            },
 /* . . . . . . . . . . . . . . . . . . . */   
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
            },
/* . . . . . . . . . . . . . . . . . . . */             
            loadImage(e) {
                this.fileImage = e.target.files
            },
/* . . . . . . . . . . . . . . . . . . . */             
            saveh() {
               console.log(this.namebrand, this.fileImage[0])

               let formData = new FormData();
                formData.append('name', this.namebrand)
                formData.append('image', this.fileImage[0])

                let config = {
                    headers: {                    /* ___1___ */
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                axios.post(this.urlBase, formData, config)
                 .then(response => {
                        this.transactStatus = 'added'      /* ___3___ */
                        this.transactDetails = {
                            message:'Register ID: '+response.data.id
                        }
                        console.log(response)
                    })
                    .catch(errors => {
                        this.transactStatus = 'error'
                        this.transactDetails = {
                            message: errors.response.data.message,
                            dbdatas:errors.response.data.errors

                        }
                        //errors.response.data.message
                    })
            }
/* . . . . . . . . . . . . . . . . . . . */          
        },
/* . . . . . . . . . . . . . . . . . . . */      
        mounted() {  /* ___5___ */
            this.loadList()
        }
    }
/* . . . . . . . . . . . . . . . . . . . */ 
/* . . . . . . . . . . . . . . . . . . . */ 

/*
 - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    EXPLICAÇÃO
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

___1___ - Adiciona o token de autorização  no cabeçaho da Requisição
___2___ - Utilização da Biblioteca Axios, já disponível em js, substitui
a outra também default, chamada FETCH
___3___ - transactStatus - se a requisição do axios for true, retorna added,
senão error, depois o resultado de retorno é usado no component alert - usando
um v-if.
___4___ - transactDetails - valor da props details do componente alert, é o
resultado da requisição feita no axios. Uso do Bind ":". Dentro do componente
alert possui um props chamado details, onde é chamado: details.data.message.
Também tem o details.data.errors, onde os erros são listados usando um v-for
___5___ - Atributo mounted - é usado quando os componentes são carregados,
quando estiverem montados(mounted), é executado uma ação: no caso: loadList



- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
      EXPLANATION
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

___1___ - Adds the authorization token to the Request header
___2___ - Use of the Axios Library, already available in js, replaces
the other also default, called FETCH
___3___ - transactStatus - if the axios request is true, returns added,
otherwise error, then the return result is used in component alert - using
a v-se.
___4___ - transactDetails - value of the props details of the alert component, it is the
result of the request made in axios. Use of Bind ":". inside the component
alert has a props called details, where it is called: details.data.message.
There is also details.data.errors, where errors are listed using a v-for
___5___ - mounted attribute - is used when components are loaded,
when they are mounted, an action is executed: in this case: loadList

*/


</script>

