<template>
    <div class="container">
        <p>{{text}}</p>
        <button v-on:click="validate">Yes</button>
        <button v-on:click="$emit('close')">No</button>
    </div>
</template>

<script>
    export default { 
        props:{
            text:{
                type: String
            }, 
            data:{
            }, 
            storeDispatchFunction:{
                type: String
            }
        },
        data: function () {
            return {
            }
        },
        computed:{
        },
        mounted() {
        },
        methods:{
            validate: function(){
                if(this.storeDispatchFunction != null && this.data != null){
                    this.$store.dispatch(this.storeDispatchFunction, this.data);
                }else if (this.storeDispatchFunction != null){
                    this.$store.dispatch(this.storeDispatchFunction);
                }
                this.$emit('close');
            },
        }
    }
</script>


<style scoped lang="scss">

</style>