<template>
    <span class="date-picker">
        <span class="static" v-on:click="toggleEditMode" v-if='!editMode'>
            {{modifiedDate | moment('DD/MM/YYYY')}}
        </span>
        <span class="edit" v-else>
            <datepicker :value="modifiedDate" @selected="updateDate"></datepicker>
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
            var app = this;

            EventBus.$on('updatedWorkshop', function(data){
                if(data[0] == app.property && data[1] == true){
                    this.editMode = false;
                }
            }.bind(app));
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
                console.log(this.getSqlDateFormat(this.modifiedDate))
                EventBus.$emit('updateWorkshop', [this.property, this.getSqlDateFormat(this.modifiedDate)]);
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