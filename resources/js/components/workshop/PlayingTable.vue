<template>
    <div class="playing-table">
        <router-view></router-view>
        
        <div class="setting-page" v-on:click="toggleTeamSettings" v-if="isAuthor">
            <img src="/icons/settings.svg" alt="">
        </div>
    </div>
</template>

<script>
    export default {
        props:{
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
        }
    }
</script>