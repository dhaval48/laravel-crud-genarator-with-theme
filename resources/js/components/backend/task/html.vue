<template>
<div>
    <div class="col-md-12">
        <form class="form" method="POST" :action='this.module.store_route' @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">

            <input type="hidden" name="id" :value="this.module.id" v-if="this.module.id != 0">
            <div class="row">
                
                <div class='col-sm-6'>
                    <div :class='form.errors.has("name")?"form-group has-error":"form-group"'>
                        <label for='name'> {{this.module.lang.name}} </label>

                        <input type='text' name='name' class='form-control' v-model='form.name'>
                        <span class='help-block text-danger' 
                        v-if='form.errors.has("name")'
                        v-text='form.errors.get("name")'></span>
                    </div>
                </div>
                
                <div class='col-sm-6'>
                    <div :class='form.errors.has("status")?"form-group has-error":"form-group"'>
                        <label for='status'> {{this.module.lang.status}} </label>
                        
                        <select class='form-control select-form' ref='status' name='status' v-model='form.status'>
                            <option value=''>Select status</option>
                            <option v-for='(value, key) in status' :value='key'>{{value}}</option>
                        </select>

                        <span class='help-block text-danger' 
                        v-if='form.errors.has("status")'
                        v-text='form.errors.get("status")'></span>
                    </div>
                </div>
                
                <div class='col-sm-6'>
                    <div :class='form.errors.has("description")?"form-group has-error":"form-group"'>
                        <label for='description'> {{this.module.lang.description}} </label>

                        <input type='text' name='description' class='form-control' v-model='form.description'>
                        <span class='help-block text-danger' 
                        v-if='form.errors.has("description")'
                        v-text='form.errors.get("description")'></span>
                    </div>
                </div>
                
            </div>
            <div class="row">
            <!-- [GridVueElement-1] -->
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <file_upload ref="file_upload" :module='this.module'></file_upload>
                </div>
            </div>
            
            <div class="clearfix">&nbsp;</div>
            
            <div class="card-actionbar">
                <div class="card-actionbar-row">
                    <button type="submit" class="btn btn-flat btn-primary" :disabled="form.errors.any()">{{this.module.common.save}}</button>
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
             status : [],
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
                this.$root.$emit('tasksCreated', response);
                this.$parent.activity_init();

            }).catch(function(){});
        }
    },
    mounted() {
            
         
		this.form.status = this.form.status ? this.form.status : '';
		
        if(this.module.status_search) {
            axios.get(this.module.status_search).then(data => {
                this.status = data.data;
            });
        }
        // [DropdownSearch]
    }
}
</script>