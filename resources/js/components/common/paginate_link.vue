<template>
    <div class="card-footer">            
        <ul class="pagination justify-content-center m-0" v-if="this.$parent.q == '' && pagination.last_page > 1">
            <li class="page-item" v-if='pagination.current_page > 1'>
                <a href="javascript:void(0);" aria-label="Previous" class="page-link" 
                @click="getPageData(pagination.current_page - 1)">
                    <span aria-hidden="true">Previous</span>
                </a>
            </li>

            <li v-for="page in pagination.last_page"
                class="page-item" 
                v-bind:class="[ page == pagination.current_page ? 'active' : '']"
            >
                <a href="javascript:void(0);" @click="getPageData(page)" class="page-link" >{{ page }}</a>
            </li>

            <li class="page-item" v-if='pagination.current_page < pagination.last_page'>
                <a href="javascript:void(0);" class="page-link" 
                    @click="getPageData(pagination.current_page + 1)">
                    <span aria-hidden="true">Next</span>
                </a>
            </li>
        </ul>
    </div>
</template>


<script>

export default {
    props:['lists'],   

    data(){
        return {
            pagination:this.lists.lists
        }
    },

    watch:{
        lists(data){
            this.pagination = this.lists.lists;
        }
    },

    methods: {

        getPageData:function(page){
            axios.get(this.lists.paginate_route+'?page='+page).then(data => data.data.data)
            .then(data => {
                this.$parent.lists = data;
                this.pagination = data.lists
            });
        }
    },

    mounted(){
        
    }
}
</script>
