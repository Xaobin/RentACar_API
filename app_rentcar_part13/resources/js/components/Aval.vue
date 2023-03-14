<template>
<div>
<!-- The Modal -->
<div id="id01" class="ymodal" v-on:click="vvvNoMouse()">
  <div class="ymodal-content" @mouseover="mousein='true'"
    @mouseout="mousein='false'">
    <div class="container">
      <span @click="vvvNoShow()"
      class="yclose">&times;</span>
      <p>Some text in the Modal..</p>
      <p>Some text in the Modal..</p>
    </div>
    <button type="button" class="btn btn-secondary" @click="vvvNoShow()">Close</button>
  </div>
</div>
</div>




   

</template>
<script>

export default {
     props:['titles','modalname','opened','jobj'],
     data() {
            return {
                mousein:'true'
            }
        },
     methods:{
         vvvNoShow(){
            document.getElementById('id01').style.display='none';
        },
        vvvNoMouse(){
            if (this.mousein=='false'){
                document.getElementById('id01').style.display='none';
            }
        },
     }
    
}    

 </script>
