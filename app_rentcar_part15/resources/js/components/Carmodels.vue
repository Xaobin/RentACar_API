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
           placeholder="name of brand" v-model="namemodel">
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
     <table-cp :dbdatas="modelsdata"
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
/*
id, brand_id, name, image, doors, seats. air_bag, abs, created_at, updated_at
*/
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
               brand_id:{title:'Brand', typer:'fk', inptype:'text'},
               //created_at:{title:'Created', typer:'date',inptype:'text'},
               config:{title:'Operations', amountcolls: 1 },
               };
                return atitles;
            }
        },
        data() {
            return {
                urlBase: '/api/v1/model',
                namemodel:'',
                fileImage: [],
                transactStatus: '',
                transactDetails: {},
                modelsdata:[],
                fileInputKey: 0,
                evtarget:'',
                selected:'id',
                inpSearchId:'',
                inpSearchName:'',
               // datasearch:[],
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
              this.modelsdata = response.data;
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
   
 /* . . . . . . . . . . . . . . . . . . . */
  updateh() {
    this.$store.state.transact.status='';
    this.$store.state.transact.message='';
    this.namemodel=this.$store.state.item.name; 
    
    let formData = new FormData();
    formData.append('_method', 'PATCH');
    formData.append('name', this.namemodel);
 
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
          // this.$store.state.item.name=this.namemodel;
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
              this.modelsdata = response.data
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
        console.log(this.namemodel, this.fileImage[0])

        let formData = new FormData();
        formData.append('name', this.namemodel)
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


</script>

