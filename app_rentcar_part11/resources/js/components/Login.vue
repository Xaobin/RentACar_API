<template>
    <div class="container">
    <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
        <div class="card-header">Login</div>
    
        <div class="card-body">
    <!-- - - - [FORM BEGIN] - - - - - - - - - - - - - - - - - - - -  -->        
         <form method="POST" action="" @submit.prevent="login($event)">
    <!--  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->                       
    <!-- [EMAIL] - - - - -[bind :] [V-model]  - - - - - - - - - - - - -->
        <div class="row mb-3">
         <input type="hidden" name="_token" :value="csrf_token">
         
            <label for="email" class="col-md-4 col-form-label text-md-right"  >E-mail</label>
          <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="" required autocomplete="email" autofocus v-model="email">
          </div>                       
        
        </div>
    <!-- ----------------- - - - - - - - - - - - - - - - - - - - - - - -->
    <!-- ------[Password]--[v-model]--------- - - - - - - - - - - - -  -->
        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" v-model="password">
            </div>
        </div>
    <!-- ----[REMEMBER]--------- - - - - - - - - - - - - - - - - - - - - -->
        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>
            </div>
        </div>
    <!-- ------[FORGOT]------- - - - - - - - - - - - - - - - - - - - - - - -->
        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Login
                </button>
                <a class="btn btn-link" href="#">Forgot password</a>
            </div>
        </div>
    <!-- ----------------- -->
      </form>
    <!-- ----------------- -->
                </div>
            </div>
        </div>
    </div>
    </div>
    
</template>

<script>

     //Code explanation in the end
     //explanation codes: *number*   
     //[English and português]
     export default {
        /*........................................................ PREPARE ....... */
        props:['csrf_token'], // *1*
        data(){               // *2*
            return {
                email:'',
                password:''
               
            }
            
        },
/* ...................................................... TRIGGER AND SHOOT  */
        methods:{
            login(e){
                //let url="http://127.0.0.1:8000/api/login";
                //this.myurl=this.uri;
                let url="/api/login";
                //let url="http://127.0.0.1:8000/v1/loginb";
                //let homeurl="http://127.0.0.1:8000/home";
                let homeurl="/home";
                let tokk='';
                let confs = {     // *3*
                        method: 'post',
                        body: new URLSearchParams({  //*4*
                            'email': this.email,
                            'password': this.password
                        })
                    }
                  
                    fetch(url,confs) // *5*
                     .then(
                        response=>response.json()) // *6*
                     .then(data=>{ // *7*
                        if (data.token){ // *8*
                            tokk=data.token.split('&&&');
                            document.cookie = 'token='+tokk[0]+';SameSite=Lax';
                            document.cookie = 'checks='+tokk[1]+';SameSite=Lax'; 
                            document.cookie = 'name='+tokk[2]+';SameSite=Lax'; 
                            sessionStorage.setItem("token", data.token); 
                        }
                        e.target.submit(); // *10*
                        window.location.href = homeurl;
                     })

                    
            },
            createVar(){
                document.cookie="token=; path=/;";
                document.cookie="checks=; path=/;";
                document.cookie="name=; path=/;";
            }
        },
/* . . . . . . . . . . . . . . . . . . . */      
        mounted() {  /* ___5___ */
            this.createVar()
        }
/* . . . . . . . . . . . . . . . . . . . */ 
/* . . . . . . . . . . . . . . . . . . . */ 
     }
/* . . . . . . . . . . . . . . . . . . . */      
     /*
    [ENGLISH]
    *1* = Props, these are properties forwarded into instances of vue components
    *2* = The data is a little different, it is in method format, which retrieves 2 attributes
    *3* = confs are the settings (configuration)
    *4* = UrlSearchParams is a native javascript variable, it's a form of encoding - remember "x-www-encoded" from postman. 
    It's the formatting type, instantiates the obj.
    *5* = FETCH = responsible for performing HTTP requests, retrieves the request response asynchronously
    *6* = Supposedly chains response in json, to be confirmed
    *7* = Data is the content of the chained response, with the then
    *8* = data.token is retrieved to store in the front end of the application
    *9* = Information is saved in the cookie part of the browser
    *10* = Retrieves the event to actually send the form - asynchronous.*
     [PORTUGUÊS]
     *1* = Props, são propriedades encaminhadas para dentro de instâncias de componentes vue
     *2* = O data está um pouco diferente, está em formato de método, que recupera 2 atributos
     *3* = confs são as configurações
     *4* = UrlSearchParams é uma variável nativa do javascript, é uma forma de encoding - lembrar de "x-www-encoded" do postman. 
     É o tipo da formatação, instancia o obj.
     *5* = FETCH = responsável por realizar requisições HTTTP, recupera de forma assíncrona a resposta da requisição
     *6* = Supostamente encadeia a resposta em json, a confirmar
     *7* = Data é o conteúdo da resposta encadeada, com o then
     *8* = data.token é recuperado para guardar no front end da aplicação
     *9* = As informações são salvas na parte cookie do browser
     *10* = Recupera o evento para de fato disparar o formulário - assíncrono.
     
     */

    
</script>

