<template>
<div>
    <div class="col-md-12">
        <form class="form" method="POST" :action='this.module.store_route' @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)" enctype='multipart/form-data' id="setting_form">

            <input type="hidden" name="id" :value="this.module.id" v-if="this.module.id != 0" id >
            
			<div class="row">
                <!-- <div class='col-sm-6'>
                    <div :class='form.errors.has("enable_registration")?"form-group has-error":"form-group"'>
                        <p-input type='checkbox' name='enable_registration' class='p-icon p-rotate p-bigger' color='primary' v-bind:true-value='1' v-bind:false-value='0' v-model='form.enable_registration'>
                            <i slot="extra" class="icon fa fa-check"></i>
                            {{this.module.lang.enable_registration}}
                        </p-input>
                        <span class='help-block text-danger' 
                        v-if='form.errors.has("enable_registration")'
                        v-text='form.errors.get("enable_registration")'></span>
                    </div>
                </div> -->
                
                <div class='col-sm-6'>
                    <div :class='form.errors.has("app_name")?"form-group has-error":"form-group"'>
                        <label for='app_name'>{{this.module.lang.app_name}}</label>
                        <input type='text' name='app_name' class='form-control' v-model='form.app_name'>
                        
                        <span id='app_name-error' class='help-block text-danger' 
                        v-if='form.errors.has("app_name")'
                        v-text='form.errors.get("app_name")'></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div :class='form.errors.has("favicon")?"form-group has-error":"form-group"'>
                        <label for='favicon'>{{this.module.lang.favicon}}</label><br>
                        <input type="file" class="hide d-none" id="files" name="favicon" ref="files"/>
                        <button type="button" class="btn btn-primary btn-sm" v-on:click="addFiles()">{{this.module.common.add_files}}</button>
                    </div>
                </div>
                
			</div>
            
            <div class="row">
                <div class='col-sm-6'>
                    <div :class='form.errors.has("nav_color")?"form-group has-error":"form-group"'>
                        <label for='nav_color'>{{this.module.lang.nav_color}}</label>

                        <select class='form-control select-form' ref='nav_color' name='nav_color' v-model='form.nav_color'>
                            <!-- <option value=''>Select Color</option> -->
                            <option v-for='(value, key) in nav_colors' :value='value'>{{value}}</option>
                        </select>
                        <span class='help-block text-danger' 
                        v-if='form.errors.has("nav_color")'
                        v-text='form.errors.get("nav_color")'></span>
                    </div>
                </div>

                <div class='col-sm-6'>
                    <div :class='form.errors.has("side_color")?"form-group has-error":"form-group"'>
                        <label for='side_color'>{{this.module.lang.side_color}}</label>

                        <select class='form-control select-form' ref='side_color' name='side_color' v-model='form.side_color'>
                            <!-- <option value=''>Select Color</option> -->
                            <option v-for='(value, key) in side_colors' :value='value'>{{value}}</option>
                        </select>
                        <span class='help-block text-danger' 
                        v-if='form.errors.has("side_color")'
                        v-text='form.errors.get("side_color")'></span>
                    </div>
                </div>
            </div>

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
            nav_colors : Object.values(this.module.nav_colors),
            side_colors : Object.values(this.module.side_colors),
             // [OptionsData]
        }
    },
    methods: {
        addFiles(){
            this.$refs.files.click();
        },
        onSubmit() {   
            let formData = new FormData($("#setting_form")[0]);         
            this.form.postWithFile(this.module.store_route, formData).then(response => {
                
                this.$root.$emit('settingsCreated', response);
            }).catch(function(){});
        }
    },
    mounted() {
    }
}
</script>