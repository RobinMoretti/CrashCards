<template>
    <div class="axios-input">
        <div class="static" v-on:click="toggleEditMode" v-if="!editMode && editable">
            <component :is="tag" class="m-0 mr-3">
                {{content}}
            </component>
            <img src="/icons/edit.svg" alt="">
        </div>

        <div class="edit" v-if="editMode && editable">
            <input 
            type="text" 
            id="content-input" 
            name="content-input" 
            maxlength="50" 
            v-model="inputContent"
            v-on:keydown.enter="update"
            v-if="inputTag == 'input'"
            >

            <textarea 
            id="story" 
            name="story"
            v-model="inputContent"
            rows="5" cols="60"
            v-if="inputTag == 'textarea'">
            </textarea>

            <img src="/icons/save.svg" alt="" class="save" v-on:click="update">
        </div>

        <div class="not-editable" v-if="!editable">
            
            <div 
            class="checkbox"
            v-if="inputTag == 'checkbox'"
            >
                <label for="checkbox" v-if="label">{{ label }}</label>
                <input 
                type="checkbox" 
                id="checkbox" 
                v-model="inputContent" 
                v-on:change="update"
                item-value="name"
                >
            </div>
        </div>
    </div>
</template>

<script>
    import EventBus from '../event-bus';

    export default {
        props:{
            tag: {
                default: 'p',
                type: String
            },
            inputTag: {
                default: 'input',
                type: String
            },
            content:{
            }, 
            property: {
                type: String
            }, 
            label: {
                type: String
            },
            editable:{
                type: Boolean,
                default: true
            }
        },
        data: function () {
            return {
                editMode: false,
                inputContent: this.content,
                inputCheckboxContent: this.content,
            }
        },
        methods: {
            toggleEditMode: function(){
                this.editMode = !this.editMode;
                if(this.inputTag != "checkbox"){
                    this.inputContent = this.content;
                }
            },
            update: function(){
                console.log('try to emited')
                console.log("this.inputContent = " + this.inputContent);

                if(this.checkInputContent(this.inputContent)){
                    console.log('emited');

                    const payload = {
                        "property": this.property,
                        "content": this.inputContent,
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

                }
                
                this.toggleEditMode();
            },
            checkInputContent: function(content){
                // if(this.inputContent.length > 0 || this.inputContent == true)
                if(content > 0 || content == true || content == false){
                    return true;
                }
                    
                return false;
            }
        }
    }
</script>

<style scoped lang="scss">
    .axios-input{
        .static{
            display: flex;
            justify-content: flex-start;
            align-items: center;
            cursor: pointer;
        }

        .save{
            cursor: pointer;
        }
    }

</style>