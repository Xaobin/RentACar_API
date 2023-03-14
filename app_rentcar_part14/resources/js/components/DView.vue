<template>
<modal-cp :id="modalname" title="View " >
       <template slot="alerts"></template>
       <template slot="content">
       {{jobj}}
          <div  v-for="t, key in titles" :key="key">
          <input-cp v-if="((t.title!='Operations')&&(t.typer!='image'))" :title="t.title">:
          </input-cp> 
          <input-cp v-if="((t.title!='Operations')&&(t.typer=='image'))" :title="t.title">:
           <img :src="'/'+key" width="30" height="30">
          </input-cp>
          </div>
   
          
       </template>
       <template slot="footer">
      
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       </template>
      
   </modal-cp>
</template>

<script>

//{{$store.state.item[key]}}
export default {
     props:['titles','modalname','jobj'],
/* . . . . . . . . . . . . . . . . . . . */         
        methods: {
 /* . . . . . . . . . . . . . . . . . . . */       
    
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