<template>
    <div>
        <div class="card-header">
            <h3 class="card-title">{{ this.lists.lang.list }}</h3>

            <div class="card-tools">
                <div class='input-group input-group-sm'>
                    <input type="text" id="q" placeholder="Search" v-on:keyup.enter.prevent="filterList" v-model="q" class="filter-input form-control">
                    <span class='btn btn-default input-group-append' v-on:click.prevent="filterList"><i class='fa fa-search'></i></span>

                    <div v-if="this.lists.is_visible" class="btn-group pull-right">
                        <button  type="button" class="btn btn-success btn-sm dropdown-toggle pull-right" data-toggle="dropdown" tabindex="-1" aria-haspopup="true" aria-expanded="false">
                            {{this.lists.common.export}}
                        </button>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" target="_blank" :href='this.lists.paginate_route+"?q="+q+"&pdf=1"'>{{this.lists.common.pdf}}</a>
                            <a class="dropdown-item" target="_blank" :href='this.lists.paginate_route+"?q="+q+"&csv=1"'>{{this.lists.common.csv}}</a>
                        </div>
                    </div>

                    <a v-if="this.lists.permissions['store_'+this.lists.dir]" :href="this.lists.create_route" class="btn btn-info btn-sm pull-right" style="margin-left:5px">{{this.lists.lang.create_title}}</a>
                </div>

                <!--  -->
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props:['lists'],   

    data(){
        return {
            q:'',
        }
    },

    watch:{
        
    },

    methods: {
        filterList:function(){
            axios.get(this.lists.paginate_route+'?q='+this.q).then(data => data.data.data)
            .then(data => {
                this.$parent.q = this.q;
                this.$parent.lists = data;
            });
        },
    },

    mounted(){
        
    }
}
</script>