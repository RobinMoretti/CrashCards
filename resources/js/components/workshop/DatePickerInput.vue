<template>
    <span class="date-picker">
        <span class="static" v-on:click="toggleEditMode" v-if='!editMode'>
            {{ date | moment('DD/MM/YYYY') }}
        </span>
        <span class="edit" v-else>
            <datepicker :value="date" @selected="updateDate"></datepicker>
        </span>
    </span>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import EventBus from '../../event-bus';

    export default {
        components: {
            Datepicker
        },
        mounted() {
        },
        props:{
            date: {
                type: String,
            },
            property: {
                type: String
            },
        },
        data: function () {
            return {
                modifiedDate: new Date(this.date),
                editMode: false,
            }
        },
        methods: {
            toggleEditMode: function(){
                this.editMode = !this.editMode;
            },
            updateDate: function(date){
                this.modifiedDate = date;

                const payload = {
                    "property": this.property,
                    "content": this.getSqlDateFormat(this.modifiedDate),
                }

                this.$store.dispatch('setWorkshopProperty', payload).then(
                    resolve => {
                        console.log('success')
                    }, 
                    reject => {
                        console.log('reject')
                        this.flash('Something was wrong, try later.', 'error');
                    }
                )

                this.toggleEditMode();
            },
            getSqlDateFormat(date){
                return date.toISOString().slice(0, 19).replace('T', ' ')
            }
        }
    }
</script>

<style scoped lang="scss">
    .date-picker{
        .edit{
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .static{
            color: red;
            text-decoration: underline;
            cursor: pointer;
        }
    }
</style>