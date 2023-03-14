<template>
    <div :class="estilo" role="alert">
        {{title}}
        <hr>
        <span v-if="details.data.message">{{details.data.message}}</span>
        <span v-if="details.data.id">{{'Register ID: ' + details.data.id}}</span>
        <br>
        <ul v-if="details.data.errors">
            <li v-for="e, key in details.data.errors" :key="key">{{ e[0] }}</li>
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
