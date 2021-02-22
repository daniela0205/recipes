<template>
 <input
 type="submit"
 class="btn btn-danger d-block w-100 mb-2"
 value="Delet"
 v-on:click="deleteRecipe"
 >
</template>

<script>
export default {
    props:['recipeId'],
    methods:{
        deleteRecipe(){
            this.$swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                // cancelButtonText: 'No'
              }).then((result) => {
                if (result.value) {
                    // send the required at server
                    const params ={
                        id: this.recipeId
                    }
                    axios.post(`./recipes/${this.recipeId}`,{params, _method: 'delete'})
                        .then(response=> {
                           this.$swal({
                               title:'Recipe Deleted',
                               text:'The recipe was deleted',
                               icon:'success'
                            })     
                                // Delet recipe from DOM
                            this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);

                        })
                        .catch(error=>{
                            console.log(error.response)
                        })

                }
            })

        }
    }
}
</script>



