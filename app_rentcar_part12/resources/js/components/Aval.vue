<template>
<modal-cp :id="modalname" title="Add Some">

      <template v-slot:footer>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"  
        @click="saveh()">save</button>
        </template>
    </modal-cp>
</template>
<script>
export default {
     props:['titles','jobj','modalname'],

}    
 </script>
