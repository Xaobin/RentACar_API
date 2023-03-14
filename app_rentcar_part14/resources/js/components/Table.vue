<template>
    <div>
    <table class="table table-hover">
        <thead>
        <tr>
        <th scope="col" v-for="t, key in titles" :key="key">{{t.title}}</th>
        </tr>
        </thead>
        <tbody>
            <tr v-for="obj, keyx in filterDatasII" :key="keyx">
            <td v-for="value, keyValue in obj" :key="keyValue">
<span v-if="((keyValue!= 'image')&&(keyValue!='nid'))">{{value}}</span>

<span v-if="keyValue == 'image'">
    <img :src="'/'+value" width="30" height="30">
</span>
<span v-if="keyValue == 'nid'">
<a type="button" v-if="dview.visible"  @click="setStore(obj)"
  class="btn btn-sm btn-outline-secondary">View</a>

<a type="button" v-if="dview.visible"  @click="setStoreUpd(obj)"
  class="btn btn-sm btn-outline-secondary">Update</a>

  <a type="button" v-if="dview.visible"  @click="setStoreDel(obj)"
  class="btn btn-sm btn-outline-secondary">Delete</a>


</span>
            </td>
            
            </tr>
        </tbody>
    </table>








</div>
</template>

<script>
//import store from 'vuex';

export default {
        props: ['dbdatas', 'titles', 'dview','dupd','ddel'],
          data() {
            return {
                openmodal:'false',
                mousein:'true',
                jobj:{}
            }
        },
        methods:{
            setStore(obj){
                this.$store.state.item=obj;
               let mdname=this.dview.dataTarget; 
                document.getElementById(mdname).style.display='block';
            },
         setStoreUpd(obj){
                this.$store.state.item=obj;
               let mdname=this.dupd.dataTarget; 
                document.getElementById(mdname).style.display='block';
            },
        setStoreDel(obj){
                this.$store.state.item=obj;
               let mdname=this.ddel.dataTarget; 
                document.getElementById(mdname).style.display='block';
            },
            
    },

        computed: {
            filterDatas() {

                let titlefields = Object.keys(this.titles)
                let filterArray = []

                this.dbdatas.map((item, keyx) => {
        //console.log("Object_"+item.id+" - "+item.name+" - "+item.created_at);
        //console.log();
                    let filterItem = {}
                    titlefields.forEach(field => {

                        filterItem[field] = item[field] //utilizar a sintaxe de array para atribuir valuees a objetos
                    })
                    filterArray.push(filterItem)
                })
   this.dbdatas.forEach(function(entry) {console.log(entry);});
                return filterArray //retorne um array de objetos
             },
        filterDatasII(){
         let neovar=[];
         let elem={};
         var nid=0;
         let titlefields = Object.keys(this.titles);

        this.dbdatas.forEach(jobj => {
        Object.entries(jobj).forEach(([khey, vall]) => {
          
            const inkey = titlefields.includes(khey);
            if (inkey==true){
            titlefields.forEach((kk,ii)=>{ 
             
               
                if ((this.titles[kk].typer=="id")&&(nid==0))
                { nid=vall; elem[khey]=vall; } 
                   
                if (ii>0)   {
              
                    elem[khey]=vall;
                    
                }  
                 
            }); 
           
          }
        
        });
        let tmp=nid;
        let lele=this.titles.config.amountcolls;
        for (var i = 1; i <= lele; i++) {
            elem['nid']=nid;    
            if (i>1){ elem['nid'+i]=nid; }
        }    
        
         neovar.push(elem);
                elem={};
                nid=0;
            
         
    });
    //neovar.forEach((ell)=>{ console.log(ell); })
            return neovar;  

             }
// - - - - - - - - - - - - - - - - - -                     
        },
// - - - - - - - - - - - - - - - - - -        
mounted() {
   
},        
// - - - - - - - - - - - - - - - - - -        
}
// - - - - - - - - - - - - - - - - - -     
   
</script>


