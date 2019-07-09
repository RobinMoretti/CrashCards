<template>
    <div class="workshop-input">
        <axios-input 
        tag="h1"
        property="name"
        :content="workshop.name"
        default-content="Workshop name"
        ></axios-input> 

        <axios-input 
        tag="p"
        property="description"
        :content="workshop.description"
        default-content="Workshop description"
        inputTag="textarea"
        ></axios-input> 

        <h3 class="mt-0">Hosted by {{ workshop.author.name }}</h3>
        
        <p>
            Start 
            <date-picker-input :date="workshop.start_date" property="start_date"></date-picker-input> 
            finish at 
            <date-picker-input :date="workshop.end_date" property="end_date"></date-picker-input> 
        </p>

    </div>
</template>

<script>

    export default {
        mounted() {
        },
        props:{
        },
        data: function () {
            return {
            }
        },
        methods: {
        }
    }
</script>

<style scoped lang="scss">

</style>