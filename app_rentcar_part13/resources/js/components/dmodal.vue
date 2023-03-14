<template>
<div>
<!-- The Modal -->
<div :id="modalname" class="ymodal" v-on:click="vvvNoMouse()">
  <div class="ymodal-content" @mouseover="mousein='true'"
    @mouseout="mousein='false'">
    <div class="container">
    <h5 class="modal-title" :id="modalname">{{title}}</h5>
    <hr>
      <span @click="vvvNoShow()"
      class="yclose">&times;</span>
       <slot name="alerts"></slot>
       <slot name="content"></slot>
    </div>
    <button type="button" class="btn btn-secondary" @click="vvvNoShow()">Close</button>
     <slot name="footer"></slot>
  </div>
</div>
</div>




   

</template>
<script>

export default {
     props:['title','modalname','jobj'],
     data() {
            return {
                mousein:'true'
            }
        },
     methods:{
         vvvNoShow(){
            let name=this.modalname;
            document.getElementById(name).style.display='none';
        },
        vvvNoMouse(){
            if (this.mousein=='false'){
                let name=this.modalname;
                document.getElementById(name).style.display='none';
            }
        },
     }
    
}    

 </script>
