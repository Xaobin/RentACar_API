<template>
<modal-cp :id="modalname" title="View " >
       <template slot="alerts"></template>
       <template slot="content">
          <div  v-for="t, key in titles" :key="key">
          <input-cp v-if="t.title!='Operations'" :title="t.title">
          
           {{jobj[key]}} 
       
          </input-cp>
          </div>
   
          
       </template>
       <template slot="footer">
       <button type="button" class="btn btn-secondary"
        @click="dval()">dval</button>
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       </template>
      
   </modal-cp>
</template>

<script>
export default {
     props:['titles','jobj','modalname'],
/* . . . . . . . . . . . . . . . . . . . */         
        methods: {
 /* . . . . . . . . . . . . . . . . . . . */       
    dval(){
        //console.log("Item Id:"+itId);
        //this.$root.$emit('loadListEvent');
        location.reload();
    },
 /* . . . . . . . . . . . . . . . . . . . */  
   viewh(itId){
    let config = {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                axios.get(this.urlBase+"/"+itId, config)
                    .then(response => {
                        this.idbrand = response.data.id;
                        this.namebrand=response.data.name;
                        this.createdbrand=response.data.created_at;
                        console.log(this.brandsdata)
                    })
                    .catch(errors => {
                        console.log(errors)
                    })
   },


}   
/* . . . . . . . . . . . . . . . . . . . */  
}
/* . . . . . . . . . . . . . . . . . . . */  
</script>