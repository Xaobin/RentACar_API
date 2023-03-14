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
     <input-cp title="name of brand" id="inputname" id-help="nameHelp" text-help="Optional. Provide the brand's name">
     <input type="text" class="form-control" id="inputname" aria-describedby="nameHelp" placeholder="name of brand">
     </input-cp>
     <!-- = = = = = = = = -->
     </div></div>
    </template>
    <template v-slot:footer>
    <button type="submit" class="btn btn-primary btn-sm float-right">Pesquisar</button>
    </template>
    </card-cp>
 <!-- = = = = = = = =  =  [End of Card:Search] = -->


 <!-- = = = = = = = =  =  =[COMPONENT][Card:List]  -->
    <card-cp title="List of brands">
    <template v-slot:content>
        <!-- = = = = = = = [Table] -->
        <table-cp></table-cp>
    </template>

    <template v-slot:footer>
      <button type="button" class="btn btn-primary btn-sm float-right" 
      data-toggle="modal" data-target="#modalbrand">Add</button>
    </template>
    </card-cp>
<!-- = = = = = = = =  =  = [End of Card:List] = -->
    </div>
    </div>

<!-- = = = = = = = =  =  =[COMPONENT][Modal:Add]-->
    <modal-cp id="modalbrand" title="Add brand">

    <template v-slot:alerts> <!-- = =[Alerts] = = -->
        <alert-cp stll="success" :details="transactdetails" title="Registration done successfully" v-if="transactStatus == 'added'"></alert-cp>
        <alert-cp stll="danger" :details="transactdetails" title="Error when trying to register the brand" v-if="transactStatus == 'error'"></alert-cp>
    </template>

    <template v-slot:content> <!-- = =[Input:Name] = = -->
        <div class="form-group">
        <input-cp title="name of brand" id="newName" id-help="newNameHelp" text-help="Inform the name of brand">
        <input type="text" class="form-control" id="newName" aria-describedby="newNameHelp" placeholder="name of brand" v-model="namebrand">
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" @click="save()">save</button>
        </template>
    </modal-cp>
    <!-- = = = = = = = =  =  [End of Modal] -->
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
                transactStatus: '',
                transactdetails: []
            }
        },
        methods: {
            loadImage(e) {
                this.fileImage = e.target.files
            },
            save() {
                console.log(this.namebrand, this.fileImage[0])

                let formData = new FormData();
                formData.append('name', this.namebrand)
                formData.append('Image', this.fileImage[0])

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                axios.post(this.urlBase, formData, config)
                    .then(response => {
                        this.transactStatus = 'added'
                        this.transactdetails = response
                        console.log(response)
                    })
                    .catch(errors => {
                        this.transactStatus = 'error'
                        this.transactdetails = errors.response
                        //errors.response.data.message
                    })
            }
        }
    }
</script>
<!-- 
|COMPONENTS| - explanation

<TEMPLATE>

|___|CARD:search|__|inputs of card search|__|

|__|CARD:List of Brands|__|Table(SLOT)|__|Add new Brand(SLOT)|__|

|__|MODAL: Add New Brand|__|Alerts(SLOT)|__|Inputs(SLOT)|__|Save(SLOT)|__|

<\TEMPLATE>



-->