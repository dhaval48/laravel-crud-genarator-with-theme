<template>
<div>
    <div class="col-md-12">
        <form class="form" method="POST" :action='this.module.store_route' @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">

            <input type="hidden" name="id" :value="this.module.id" v-if="this.module.id != 0">
            <div class="row">
                
                <div class='col-sm-6'>
                    <div :class='form.errors.has("color")?"form-group has-error":"form-group"'>
                        <label for='color'>{{this.module.lang.color}}</label>

                        <select class='form-control select-form' ref='color' name='color' v-model='form.color'>
                            <option value=''>Select color</option>
                            <option v-for='(value, key) in color' :value='value'>{{value}}</option>
                        </select>
                        <span class='help-block text-danger' 
                        v-if='form.errors.has("color")'
                        v-text='form.errors.get("color")'></span>
                    </div>
                </div>
                
            </div>
            <div class="row">
            <!-- [GridVueElement-1] -->
            </div>

            <!-- <div class="row">
                <div class="col-sm-12">
                    <file_upload ref="file_upload" :module='this.module'></file_upload>
                </div>
            </div> -->
            
            <div class="clearfix">&nbsp;</div>
            
            <div class="card-actionbar">
                <div class="card-actionbar-row">
                    <button type="submit" class="btn btn-primary" :disabled="form.errors.any()">{{this.module.common.save}}</button>
                </div>
            </div>
        </form>
    </div>
</div>
</template>

<script>
import moment from 'moment';

export default {
    
    props:['formObj','module'],

    data(){
        return {
            form:this.formObj,
             color : Object.values(this.module.color),
			// [OptionsData]
        }
    },
    methods: {
        onSubmit() {            
            this.form.post(this.module.store_route).then(response => {
                this.$refs.file_upload.submitFiles(this.module.dir, response.data.id);
                
                 // [GRID_RESET]
                if(this.module.id == 0) {
                    this.$refs.file_upload.files = [];
                    this.$refs.file_upload.name = [];
                } else {
                      this.$refs.file_upload.init();
                }
                this.$root.$emit('theme_settingsCreated', response);
                this.$parent.activity_init();

            }).catch(function(){});
        }
    },
    mounted() {
            
         
		this.form.color = this.form.color ? this.form.color : '';
		// [DropdownSearch]
    }
}
</script>