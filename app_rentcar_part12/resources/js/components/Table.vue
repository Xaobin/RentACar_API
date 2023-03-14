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
<a type="button" v-if="dview.visible" data-bs-toggle="modal" :data-bs-target="'#modalView'+value"  class="btn btn-sm btn-outline-secondary">View</a>
<!--aval-cp :titles="titles" :jobj="obj" modalname="modalView"></aval-cp -->
<dview-cp :titles="titles" :jobj="obj" :modalname="'modalView'+value"></dview-cp>


<a type="button" href="" class="btn btn-sm btn-outline-secondary">Update</a>


<a type="button" href="" class="btn btn-sm btn-outline-secondary">Delete</a>
</span>
            </td>
            
            </tr>
        </tbody>
    </table>
    </div>
</template>

<script>
    export default {
        props: ['dbdatas', 'titles', 'dview'],
        methods:{
             viOne(itId){
       //this.$root.$refs.brandcp.viewAval(itId);
       let vvv=btoa(itId);
       window.myVal = itId;
       document.cookie='wheel='+vvv+'; SameSite=Lax';
     }
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
/*
this.dbdatas.map((item, keyx) => {
console.log("Object_"+item.id+" - "+item.name+" - "+item.created_at);}
result
Object_4 - Ford - 2023-01-17T14:03:29.000000Z 
Object_12 - Volks - 2023-02-25T19:49:44.000000Z 
Object_13 - Solaris - 2023-02-25T20:45:16.000000Z 
Object_14 - Dodge - 2023-02-25T22:00:19.000000Z 
Object_15 - AAA - 2023-02-25T23:35:12.000000Z

keyx = > 0,1,2,3,4
item[keyx] => undefined
item.keyx = > undefined


filterdatas
Object { id: 4, name: "Ford", image: "images/6Qjcmw2CYxui3nBm8KxwBmAmIuK7Y697Y5B6hXDQ.jpg", created_at: "2023-01-17T14:03:29.000000Z" }
Object { id: 12, name: "Volks", image: "images/AmlO3rVPyhH2IR8gOANcYun0zS1dk0sfdQT3IW4Y.png", created_at: "2023-02-25T19:49:44.000000Z" }
Object { id: 13, name: "Solaris", image: "images/KTVnplu3KTH6noZ5ufEkJtXWBvDWIQElmDXBJX2X.png", created_at: "2023-02-25T20:45:16.000000Z" }
Object { id: 14, name: "Dodge", image: "images/YPuWvf1MtsewI9y2NK6NsDDuG7VjBSWkG2WZsFMG.jpg", created_at: "2023-02-25T22:00:19.000000Z" }
Object { id: 15, name: "AAA", image: "images/hIS8575ZHfCx0vozwh7w6UbzdmjiLINq8jalMdPR.png", created_at: "2023-02-25T23:35:12.000000Z" }
*/
</script>
