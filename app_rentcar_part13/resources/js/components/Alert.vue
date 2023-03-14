<template>
    <div :class="estilo" role="alert">
        {{title}}
        <hr>
        <!--span v-if="details.data.message">{{details.data.message}}</span>
        <span v-if="details.data.id">{{'Register ID: ' + details.data.id}}</span -->
         <span v-if="details.message">{{details.message}}</span>
        <!--span v-if="details.data.id">{{'Register ID: ' + details.data.id}}</span -->
        <span v-if="details.data">-- {{details.data}} --</span>
        <br>
        <ul v-if="details.dbdatas"> 
        <li v-for="e, key in details.dbdatas" :key="key">{{ e[0] }}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['stll', 'title', 'details'],
        computed: {
            estilo() {
                return 'alert alert-'+this.stll
            }
        }
    }
</script>
