<template>
    <div>
        <list_header :lists='this.module'></list_header>
        
        <div class="card-body table-responsive p-0">
            <table class="table table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th v-for="(value,key) in lists.list_data">{{ key }}</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>
                <tbody v-if="lists.lists.data.length > 0">
                    <tr v-for="list in lists.lists.data">
                        
                        <td v-for="(value,key) in lists.list_data">
                            <template v-if="value =='date'">
                                {{ list[value] | dmy }}
                            </template>
                            <template v-else-if = "value.indexOf('.') > 0">
                                {{ list | relation(value) }}
                            </template>
                            <template v-else>
                                {{list[value] != null ? list[value] : '-'}}
                            </template>
                        </td>
                        <td>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">Action
                                    <span class="sr-only">Toggle Dropdown</span>
                                    <div class="dropdown-menu" role="menu" x-placement="top-start">
                                        <a v-if="lists.permissions['update_'+lists.dir]" class="dropdown-item" :href='module.edit_route+"/"+list.id'>
                                            {{lists.common.edit}}
                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <a v-if="lists.permissions['delete_'+lists.dir]" class="dropdown-item text-danger" href="javascript:void(0);" @click="deleteRecord(list.id)">
                                            {{lists.common.delete}}
                                        </a>
                                    </div>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
                <tbody v-else>
                    <tr>
                        <td class="text-center" colspan="20">
                            {{lists.common.no_data}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <paginate-links :lists='this.lists'></paginate-links>
    </div>
</template>


<script>
import list_header from '../.././elements/list_header';

export default {
    props:['module'],
    components : {list_header},
    data(){
        return {
            q:'',
            lists:this.module,
            form: new Form(this.module.fillable)

        }
    },

    methods: {

        deleteRecord(id) {
            this.form.id = id
            this.$swal({
                title: 'Are you sure?',
                text: 'Are you sure you want to delete this '+this.module.dir+' ?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes Delete it!',
                cancelButtonText: 'No, Keep it!',
                showCloseButton: true,
                showLoaderOnConfirm: true
            }).then((result) => {
                if(result.value) {
                    this.form.post(this.module.destory_route).then(response =>{
                        this.lists = response.data;
                    });
                }
            });
        }
    },

    mounted(){
        
    }
}
</script>
