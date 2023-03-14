<template>
    <div class="container">
    <div class="row justify-content-center">
    <div class="container-fluid col-md-8">

 <!--
█▀ █▀▀ ▄▀█ █▀█ █▀▀ █░█
▄█ ██▄ █▀█ █▀▄ █▄▄ █▀█
 -->
 <!-- = = = = = = = =  =  =  = = [COMPONENT][Card:Search] -->


<card-cp title="Search for clients">
    <template v-slot:content>
  
<select v-model="selected">
  <option value="id" enabled><small>Search by Id</small></option>
  <option value="name"><small>Search by Name</small></option>
</select>
    
    <input type="number"  class="form-control" id="inputId" aria-describedby="idHelp" placeholder="ID" v-if="selected=='id'" v-model="inpSearchId">
     <input type="text" class="form-control" id="inputname" aria-describedby="nameHelp"
        placeholder="name of client" v-if="selected=='name'" v-model="inpSearchName">
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
<dmodal-cp modalname="modalClientAdd" title="Add client">
<template slot="alerts"> 
<alert-cp stll="success" :details="transactDetails"
title="Registration done successfully"
v-if="transactStatus == 'added'"></alert-cp>
<alert-cp stll="danger" :details="transactDetails"
title="Error when trying to register the client"
v-if="transactStatus == 'error'"></alert-cp>
</template>

       <template slot="content"> 
       
       <div class="form-group">
    <input-cp title="name of client" id="newName" id-help="newNameHelp"
        text-help="Inform the name of client">
    <input type="text" class="form-control" id="newName" aria-describedby="newNameHelp"
           placeholder="name of client" v-model="clientname">
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
<dmodal-cp modalname="modalView" title="View client">
       <template slot="alerts"></template>
       <template slot="content"> 
       <li> ID: {{$store.state.item.id}}</li>
       <li> Name: {{$store.state.item.name}}</li>
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
 <dmodal-cp modalname="modalUpd" title="Update client">
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
        
        <input-cp title="Name of client" id="updNamex" id-help="updNameHelp" text-Help="Inform the Name of client (Update)">
    
        <input type="text" class="form-control" id="updName" v-model="$store.state.item.name" aria-describedby="updNameHelp">
        </input-cp> 
        </div>
    
        
       </template>

       <template slot="footer">
        <button type="button" class="btn btn-primary" @click="updateh()">Update</button>
       </template>

   </dmodal-cp>
<!--
█▀▄ █▀▀ █░░
█▄▀ ██▄ █▄▄
-->
<dmodal-cp modalname="modalDel" title="View client">
       <template slot="alerts">
           <alert-cp stll="success" title="Deleted  with success" :details="$store.state.transact" v-if="$store.state.transact.status == 'success'"></alert-cp>
            <alert-cp stll="danger" title="error to delete proccess" :details="$store.state.transact" v-if="$store.state.transact.status == 'error'"></alert-cp>
       </template>
       <template slot="content"> 
       
       <h4>Delete the client with follow content</h4><hr>
       <li> ID: {{$store.state.item.id}}</li>
       <li> Name: {{$store.state.item.name}}</li>
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
<card-cp title="List of clients">

    <template slot="content">
     <table-cp :dbdatas="clientdata"
               :titles="titlesCP"
               :dview="{visible:true, dataTarget:'modalView'}"
               :ddel="{visible:true, dataTarget:'modalDel'}"
               :dupd="{visible:true, dataTarget:'modalUpd'}"
     ></table-cp>
      </template>

      <template slot="footer">
      <button type="button" class="btn btn-primary btn-sm float-right"
      onclick="document.getElementById('modalClientAdd').style.display='block'">Add</button>


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
               created_at:{title:'Created', typer:'date',inptype:'text'},
               config:{title:'Operations', amountcolls: 1 },
               };
                return atitles;
            }
        },
        data() {
            return {
                urlBase: '/api/v1/client',
                clientname:'',
                transactStatus: '',
                transactDetails: {},
                clientdata:[],
                fileInputKey: 0,
                evtarget:'',
                selected:'id',
                inpSearchId:'',
                inpSearchName:'',
                insearch:'false'
                
            }
        },
 /* . . . . . . . . . . . . . . . . . . . */
        methods: {
 /* . . . . . . . . . . . . . . . . . . . */
 setUpdValues(){ 
    
    this.fileInputKey=this.$store.state.item.id;
 
 },
 /* . . . . . . . . . . . . . . . . . . . */
  resetMesgs(){
  
    this.$store.state.transact.status='';
    this.$store.state.transact.message='';

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
              this.clientdata = response.data;
              this.insearch='true';
              console.log(this.datasearch);
          })
          .catch(errors => {
            alert("The resource was not found");
              console.log(" - - - -");
              console.log(errors.response.data.message);
          })


},
 /* . . . . . . . . . . . . . . . . . . . */
 /* . . . . . . . . . . . . . . . . . . . */
  updateh() {
    this.$store.state.transact.status='';
    this.$store.state.transact.message='';
    this.clientname=this.$store.state.item.name; 
    
    let formData = new FormData();
    formData.append('_method', 'PATCH');
    formData.append('name', this.clientname);
 
    

    let url = this.urlBase + '/' + this.$store.state.item.id;
    //console.log(url);
    let config = {
        headers: {
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
    })
    .catch(errors => {
        
         this.$store.state.transact.status = 'error';
         this.$store.state.transact.message = errors.response.data.message;
       
        console.log("Enter errors");
        console.log(errors.response);
        
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
              this.clientdata = response.data
              //console.log(this.clients)
          })
          .catch(errors => {
              console.log(errors)
          })
 },
/* . . . . . . . . . . . . . . . . . . . */

/* . . . . . . . . . . . . . . . . . . . */

/* . . . . . . . . . . . . . . . . . . . */
    saveh() {
        console.log(this.clientname);

        let formData = new FormData();
        formData.append('name', this.clientname)
        

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
           this.transactStatus = 'error';
           this.transactDetails = {
               message: errors.response.data.message,
               dbdatas:errors.response.data.errors
          };
          console.log(errors);

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


 

</script>

