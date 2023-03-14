<template>
    <div>
    <table class="table table-hover">
        <thead>
        <tr>
        <th scope="col" v-for="t, key in titles" :key="key">{{t.title}}</th>
        </tr>
        </thead>
        <tbody>
            <tr v-for="obj, keyx in filterDatas" :key="keyx">
            <td v-for="value, keyValue in obj" :key="keyValue">
            <span v-if="titles[keyValue].typer == 'text'">{{value}}</span>
            <span v-if="titles[keyValue].typer == 'data'"> {{ '...'+value}} </span>
            <span v-if="titles[keyValue].typer == 'image'">
                <img :src="'/storage/'+value" width="30" height="30">
            </span>
            </td>
            </tr>
        </tbody>
    </table>
    </div>
</template>

<script>
    export default {
        props: ['dbdatas', 'titles'],
        computed: {
            filterDatas() {

                let fields = Object.keys(this.titles)
                let filterArray = []

                this.dbdatas.map((item, keyx) => {

                    let filterItem = {}
                    fields.forEach(field => {

                        filterItem[field] = item[field] //utilizar a sintaxe de array para atribuir valuees a objetos
                    })
                    filterArray.push(filterItem)
                })

                return filterArray //retorne um array de objetos
            }
        }
    }
</script>
