<template>
    <div class="container">
    <div class="row justify-content-center">
    <div class="col-md-8">
<!-- - - - - - - - - - - - - - - - - - - - - - - -  -->                 
<!-- - - - - - - - - - - - - - - - - - - - - - - -  -->  
<!-- [COMPONENTS] - - - - - -  - - -[CARD]<Input>  -->            
   <card-cp  title="Search for brands"> 
    <template v-slot:content>  
     <div class="form-row">
     <div class="col mb-3">  
     <input-cp  title="ID" id="inputId" id-help="idHelp" 
     text-help="Optional, provide the Brand ID ">  
        <input type="number" class="form-control" id="inputId" aria-describedby="idHelp" placeholder="ID">
     </input-cp>                          
    </div>
    <div class="col mb-3">   
     <input-cp  title="Name of brand" id="inputName" id-help="nameHelp"
     texto-ajuda="Opcional. Informe o name of brand"> 
        <input type="text" class="form-control" id="inputNome" aria-describedby="nameHelp" placeholder="name of brand">  
     </input-cp>              
    </div>
    </div>
    </template> 
                    
    <template v-slot:footer> 
        <button type="submit" class="btn btn-primary btn-sm float-right">Search</button>
    </template>                   
  </card-cp> 
 <!-- - - - - - - - - - - - - - - - - - - - - - --> 


  <!-- - - - - -  - -  - - -  - - [Card][Table] -->
   <card-cp  title="List of Brands"> 
     <template v-slot:content> 
        <table-cp></table-cp> 
     </template>

      <template v-slot:footer> 
        <button type="button" class="btn btn-primary btn-sm float-right">Add</button>
      </template>
    </card-cp> 
 <!-- - - - - -  - -  - - -  - -  -->
            </div>
        </div>
    </div>
</template>

<script>

</script>
