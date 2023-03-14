<template>
    <div class="container">
    <div class="row justify-content-center">
    <div class="container-fluid col-md-8">

 <!--
█▀ █▀▀ ▄▀█ █▀█ █▀▀ █░█
▄█ ██▄ █▀█ █▀▄ █▄▄ █▀█
 -->
 <!-- = = = = = = = =  =  =  = = [COMPONENT][Card:Search] -->


<card-cp title="Search for brands">
    <template v-slot:content>
  
<select v-model="selected">
  <option value="id" enabled><small>Search by Id</small></option>
  <option value="name"><small>Search by Name</small></option>
</select>
    
    <input type="number"  class="form-control" id="inputId" aria-describedby="idHelp" placeholder="ID" v-if="selected=='id'" v-model="inpSearchId">
     <input type="text" class="form-control" id="inputname" aria-describedby="nameHelp"
        placeholder="name of brand" v-if="selected=='name'" v-model="inpSearchName">
     <button class="btn btn-primary btn-sm" @click="searchh()">Search</button>
   
    </template>
    </card-cp>
     <button class="btn btn-primary" v-if="insearch=='true'" @click="loadList()">
      Close Search  
     </button>



 <!-- = = = = = = = =  =  [End of Card:Search] = -->
<!--
▄▀█ █▀▄ █▀▄
█▀█ █▄▀ █▄▀
-->
<!-- = = = = = = = =  =  =[COMPONENT][Modal:Add]-->
<dmodal-cp modalname="modalBrandAdd" title="Add brand">
<template slot="alerts"> 
<alert-cp stll="success" :details="transactDetails"
title="Registration done successfully"
v-if="transactStatus == 'added'"></alert-cp>
<alert-cp stll="danger" :details="transactDetails"
title="Error when trying to register the brand"
v-if="transactStatus == 'error'"></alert-cp>
</template>

       <template slot="content"> 
       <div class="form-group">
    <input-cp title="name of brand" id="newName" id-help="newNameHelp"
        text-help="Inform the name of brand">
    <input type="text" class="form-control" id="newName" aria-describedby="newNameHelp"
           placeholder="name of brand" v-model="namebrand">
    </input-cp> 
    </div>

     <div class="form-group"> <!-- = =[Input:Image] = = -->
    <input-cp title="Image" id="newImage" id-help="newImageHelp"
    text-help="Select the image in format PNG">
    <input type="file" class="form-control-file" id="newImage" aria-describedby="newImageHelp" placeholder="Select a Image"
    @change="loadImage($event)">
    </input-cp> 
    </div>
    </template>

      <template slot="footer">
        <button type="button" class="btn btn-primary"
        @click="saveh()">save</button>
        </template>
</dmodal-cp>

    <!-- = = = = = = = =  =  [End of Modal] -->

<!--
█░█ █ █▀▀ █░█░█
▀▄▀ █ ██▄ ▀▄▀▄▀
-->
<dmodal-cp modalname="modalView" title="View brand">
       <template slot="alerts"></template>
       <template slot="content"> 
       <li> ID: {{$store.state.item.id}}</li>
       <li> Name: {{$store.state.item.name}}</li>
       <li> Image: <img :src="'/'+$store.state.item.image" width="30" height="30"></li>
       <li> Created: {{$store.state.item.created_at}}</li>
       <br>
       </template>
       <template slot="footer">
       </template>

   </dmodal-cp>
<!--
█░█ █▀█ █▀▄
█▄█ █▀▀ █▄▀
-->
 <dmodal-cp modalname="modalUpd" title="Update brand">
  <template slot="alerts">
    <alert-cp stll="success" title="Transaction performed with success" :details="$store.state.transact" v-if="$store.state.transact.status == 'success'">
    </alert-cp>
    <alert-cp stll="danger" title="error in Transaction" 
    :details="$store.state.transact" v-if="$store.state.transact.status == 'error'">
    </alert-cp>
  </template>

       <template slot="content"> 
       {{setUpdValues()}}
     <div class="form-group">
        
        <input-cp title="Name of brand" id="updNamex" id-help="updNameHelp" text-Help="Inform the Name of brand (Update)">
    
        <input type="text" class="form-control" id="updName" v-model="$store.state.item.name" aria-describedby="updNameHelp">
        </input-cp> 
        </div>
    
        <div class="form-group">
        <input-cp title="Image" id="updImage" id-help="updImageHelp" text-Help="Select  a Image no formato PNG">
        <input type="file" class="form-control-file" 
        id="updName" :key="fileInputKey"
        aria-describedby="updImageHelp" placeholder="Select a Image" @change="loadImage($event)">
        </input-cp>
        </div>
       </template>

       <template slot="footer">
       <button type="button" class="btn btn-secondary" @click="resetValues()">Clear</button>
        <button type="button" class="btn btn-primary" @click="updateh()">Update</button>
       </template>

   </dmodal-cp>
<!--
█▀▄ █▀▀ █░░
█▄▀ ██▄ █▄▄
-->
<dmodal-cp modalname="modalDel" title="View brand">
       <template slot="alerts">
           <alert-cp stll="success" title="Deleted  with success" :details="$store.state.transact" v-if="$store.state.transact.status == 'success'"></alert-cp>
            <alert-cp stll="danger" title="error to delete proccess" :details="$store.state.transact" v-if="$store.state.transact.status == 'error'"></alert-cp>
       </template>
       <template slot="content"> 
       <h4>Delete the Brand with follow content</h4><hr>
       <li> ID: {{$store.state.item.id}}</li>
       <li> Name: {{$store.state.item.name}}</li>
       <li> Image: <img :src="'/'+$store.state.item.image" width="30" height="30"></li>
       <li> Created: {{$store.state.item.created_at}}</li>
       <br>
       </template>
       <template slot="footer">
         <button type="button" class="btn btn-danger" @click="deleteh()" v-if="$store.state.transact.status != 'success'">Confirm</button>
       </template>

   </dmodal-cp>










<!--
█░░ █ █▀ ▀█▀
█▄▄ █ ▄█ ░█░
-->
<!-- = = = = = = = =  =  =[COMPONENT][Card:List]  -->
<card-cp title="List of brands">

    <template slot="content">
     <table-cp :dbdatas="brandsdata"
               :titles="titlesCP"
               :dview="{visible:true, dataTarget:'modalView'}"
               :ddel="{visible:true, dataTarget:'modalDel'}"
               :dupd="{visible:true, dataTarget:'modalUpd'}"
     ></table-cp>
      </template>

      <template slot="footer">
      <button type="button" class="btn btn-primary btn-sm float-right"
      onclick="document.getElementById('modalBrandAdd').style.display='block'">Add</button>


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
<!-- = = = = = = = =  = 
█░█ █░█ █▀▀
▀▄▀ █▄█ ██▄
 =  =  =  =  =  =  -->
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
           titlesCP(){
                 let atitles={ id:{title:'ID', typer:'id', inptype:'number'},
               name:{title:'Name', typer:'text',inptype:'text'},
               image:{title:'Image', typer:'image',inptype:'file'},
               created_at:{title:'Created', typer:'date',inptype:'text'},
               config:{title:'Operations', amountcolls: 1 },
               };
                return atitles;
            }
        },
        data() {
            return {
                urlBase: '/api/v1/brand',
                namebrand:'',
                fileImage: [],
                transactStatus: '',
                transactDetails: {},
                brandsdata:[],
                fileInputKey: 0,
                evtarget:'',
                selected:'Id',
                inpSearchId:'',
                inpSearchName:'',
                datasearch:[],
                insearch:'false'
                
            }
        },
 /* . . . . . . . . . . . . . . . . . . . */
        methods: {
 /* . . . . . . . . . . . . . . . . . . . */
 setUpdValues(){
   //if (this.$refs.updName!=undefined){
     // console.log(this.$refs.updName.value);
    //this.$refs.updName.value=this.$store.state.item.name;   
    this.fileInputKey=this.$store.state.item.id;
  // }
 },
 /* . . . . . . . . . . . . . . . . . . . */
  resetValues(){
  // this.$refs.updName.value='';
   this.evtarget.value='';
    //this.fileInputKey=-1;
    console.log(this.fileImage[0]);
    //if (this.$refs.updName!=undefined){
      console.log(this.$store.state.item.name);
   //}
   //this.$refs.updName.value='';
  },
 /* . . . . . . . . . . . . . . . . . . . */
searchh(){
    this.$store.state.transact.status='';
    this.$store.state.transact.message='';
    let vallSearch='';
    let urii="";

    if ((this.inpSearchId!='')&&(this.selected=='id')){
        let valss=window.btoa(this.selected+'&&&'+this.inpSearchId)
        vallSearch="?myfilter="+valss;
    }
    if ((this.inpSearchName!='')&&(this.selected=='name')){
        let valss=window.btoa(this.selected+'&&&'+this.inpSearchName)
        vallSearch="?myfilter="+valss;
    }
    // - - - - - - - - - - - - - - - - - -
    urii=this.urlBase+vallSearch;
   let config = {
          headers: {
              'Accept': 'application/json',
              'Authorization': this.token
          }
      }
      //console.log("List Loaded");
      axios.get(urii, config)
          .then(response => {
              this.brandsdata = response.data;
             // this.datasearch = response.data;
              this.insearch='true';
              //console.log(this.datasearch);
          })
          .catch(errors => {
            alert("the resource not found");
              console.log(" - - - -");
              console.log(errors.response.data.message);
          })


},
 /* . . . . . . . . . . . . . . . . . . . */
   viewh(){
   
    let config = {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }
                console.log("Wheel:"+this.wheel);
                axios.get(this.urlBase+"/"+this.wheel, config)
                    .then(response => {
                        console.log(">>>"+response.data);
                    })
                    .catch(errors => {
                        console.log(errors)
                    })
        
   },
 /* . . . . . . . . . . . . . . . . . . . */
  updateh() {
    this.$store.state.transact.status='';
    this.$store.state.transact.message='';
    this.namebrand=this.$store.state.item.name; 
    
    let formData = new FormData();
    formData.append('_method', 'PATCH');
    formData.append('name', this.namebrand);
 
    if(this.fileImage[0]) {
        formData.append('image', this.fileImage[0]);
        this.resetValues();
    }

    let url = this.urlBase + '/' + this.$store.state.item.id

    let config = {
        headers: {
            'Content-Type': 'multipart/form-data',
            'Accept': 'application/json',
            'Authorization': this.token
        }
    }

    axios.post(url, formData, config)
    .then(response => {
        this.$store.state.transact.status = 'success';
        this.$store.state.transact.message = 'The register was updated';
console.log("Enter response");
       //
        this.loadList();
          // this.$store.state.item.name=this.namebrand;
            //this.fileInputKey=0;
    })
    .catch(errors => {
        
         this.$store.state.transact.status = 'error';
         this.$store.state.transact.message = errors.response.data.message;
       
        console.log("Enter errors");
      
        
    })
},
 /* . . . . . . . . . . . . . . . . . . . */
  deleteh() {
    this.$store.state.transact.status='';
    this.$store.state.transact.message='';
     let formData = new FormData();
     formData.append('_method', 'delete')

     let url = this.urlBase + '/' + this.$store.state.item.id

     axios.post(url, formData)
         .then(response => {
             this.$store.state.transact.status = 'success';
             this.$store.state.transact.message = response.data.message;
             this.loadList(); 
         })
         .catch(errors => {
             this.$store.state.transact.status = 'error';
             this.$store.state.transact.message = errors.response.data.message;
         })
        

  },
 /* . . . . . . . . . . . . . . . . . . . */
  loadList() {
    this.insearch='false';
      let config = {
          headers: {
              'Accept': 'application/json',
              'Authorization': this.token
          }
      }
      //console.log("List Loaded");
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
                // e.target.value='';
                this.evtarget=e.target;
                this.fileImage = e.target.files;
               
               //console.log(e.target.files);
            },
/* . . . . . . . . . . . . . . . . . . . */

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

