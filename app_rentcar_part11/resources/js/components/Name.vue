<template>
    <span>{{namex}}</span>
</template>

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
        data(){
            namex:''
        },
        methods:{
            // - - - - - 
            getName(){
                let url="http://127.0.0.1:8000/api/auth/getname";
                 let config = {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }
                fetch(url,confs) // *5*
                     .then(
                        response=>this.namex=response.data
                     )
            }
            // - - - - -
        },
         mounted() {  /* ___5___ */
            this.getName()
        }
}
</script>
