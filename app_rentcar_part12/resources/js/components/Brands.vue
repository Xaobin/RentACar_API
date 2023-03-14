<template>
    <div class="container">
    <div class="row justify-content-center">
    <div class="col-md-8">
 <!-- = = = = = = = =  =  =  = = [COMPONENT][Card:Search] -->
   
    <card-cp title="Search for brands">
    <template v-slot:content>
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
    <template v-slot:footer>
    <button type="submit" class="btn btn-primary btn-sm float-right">Search</button>
    </template>
    </card-cp>
 <!-- = = = = = = = =  =  [End of Card:Search] = -->


<!-- = = = = = = = =  =  =[COMPONENT][Modal:Add]-->
    <modal-cp id="modalBrandAdd" title="Add brand">
    <template v-slot:alerts> <!-- = =[Alerts] = = -->
        <alert-cp stll="success" :details="transactDetails" 
        title="Registration done successfully"
        v-if="transactStatus == 'added'"></alert-cp>
        <alert-cp stll="danger" :details="transactDetails"
        title="Error when trying to register the brand" 
        v-if="transactStatus == 'error'"></alert-cp>
    </template>

       <template v-slot:content> <!-- = =[Input:Name] = = -->
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

      <template v-slot:footer>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"  
        @click="saveh()">save</button>
        </template>
    </modal-cp>
    <!-- = = = = = = = =  =  [End of Modal] -->
  















<!-- = = = = = = = =  =  =[COMPONENT][Card:List]  -->
<card-cp title="List of brands">
   
    <template slot="content">
     <table-cp :dbdatas="brandsdata"
               :titles="{
               id:{title:'ID', typer:'id', inptype:'number'},
               name:{title:'Name', typer:'text', inptype:'text'},
               image:{title:'Image', typer:'image', inptype:'file'},
               created_at:{title:'Created', typer:'date', inptype:'text'},
               config:{title:'Operations', amountcolls: 1 }, 
               }" 
               :dview="{visible:true, dataToggle:'modal', dataTarget:'#modalBrandView'}"
     ></table-cp>
      </template>
   
      <template slot="footer">
      <button type="button" class="btn btn-primary btn-sm float-right"
      data-bs-toggle="modal" data-bs-target="#modalBrandAdd">Add</button>

     
    </template>
   
    </card-cp>
<!-- = = = = = = = =  =  = [End of Card:List] = -->



</div>
</div>
</div>
<!-- = = = = = = = =  =  =  =  =  =  =  =  -->
</template>
<!-- = = = = = = = =  =  =  =  =  =  =  =  -->




<!-- = = = = = = = =  =  =  =  =  =  =  =  -->
<!-- = = = = = = = =  =  =  =  =  =  =  =  -->
<!-- = = = = = = = =  =  =  =  =  =  =  =  -->
<!-- = = = = = = = =  =  =  =  =  =  =  =  -->
<!-- = = = = = = = =  =  =  =  =  =  =  =  -->
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
            },
           wheel(){
             let wheel = document.cookie.split(';').find(ind => {
                    return ind.includes('wheel=')
                })

                wheel = wheel.split('=')[1]
                wheel=atob(wheel);
                return wheel
           } 
        },
        data() {
            return {
                opened:'false',
                urlBase: '/api/v1/brand',
                idbrand:'',
                namebrand: '',
                imagebrand:'',
                createdbrand:'',
                fileImage: [],
                transactStatus: '',              /* ___3___ */
                transactDetails: {},              /* ___4___ */
                brandsdata:[]
            }
        },
 /* . . . . . . . . . . . . . . . . . . . */         
        methods: {
 /* . . . . . . . . . . . . . . . . . . . */       
    viewAval(itId){
        console.log("Item Id:"+itId);
    },
 /* . . . . . . . . . . . . . . . . . . . */  
    printId(){
        console.log("Wheel:"+this.wheel);
        console.log("Val: "+window.myVal);
    },
 /* . . . . . . . . . . . . . . . . . . . */  
   viewh(){
    this.idbrand = '';
        this.namebrand='';
        this.imagebrand='';
        this.createdbrand='';
    let config = {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }
                console.log("Wheel:"+this.wheel);
                axios.get(this.urlBase+"/"+this.wheel, config)
                    .then(response => {
                        this.idbrand = response.data.id;
                        this.namebrand=response.data.name;
                        this.imagebrand=response.data.image;
                        this.createdbrand=response.data.created_at;
                        console.log(">>>"+response.data);
                    })
                    .catch(errors => {
                        console.log(errors)
                    })
         this.opened = true           
   },
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
                console.log("List Loaded");
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
                        console.log("\n[add]The response Value: "+JSON.stringify(response))
                         this.loadList()
                    })
                    .catch(errors => {
                        this.transactStatus = 'error'
                        this.transactDetails = {
                            message: errors.response.data.message,
                            dbdatas:errors.response.data.errors

                        }
                        
                    })
                    
            }
/* . . . . . . . . . . . . . . . . . . . */          
        },
/* . . . . . . . . . . . . . . . . . . . */      
        mounted() {  /* ___5___ */
            this.loadList();

        const thisInstance = this
        this.$root.$on('loadListEvent', function(){
      thisInstance.loadList()
         })
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

