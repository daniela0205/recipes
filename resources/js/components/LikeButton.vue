<template>
  <div>
    <span class="like-btn" v-on:click="likeRecipe" :class="{'like-active' : isActive }"></span>
    <p>{{countLikes}} likes this recipe</p>
 </div>
</template>
<script>
    export default {
        props:['recipeId','like', 'likes'],
        data: function(){
          return{
              isActive:this.like,
              totalLikes: this.likes 
          }
        },
        methods:{
          likeRecipe() {
              console.log("click liked ", this.recipeId);
              axios.post('../recipes/' + this.recipeId)
                    .then(response => {
                        if(response.data.attached.length >0){
                            this.$data.totalLikes++;
                        }
                        else{
                            this.$data.totalLikes--;
                        }

                        this.isActive = !this.isActive
                    })
                    .catch(error =>{
                        if(error.response.status ==401){
                            window.location= '/register';
                        }
                    })
          }
        },
        computed:{
          countLikes: function(){
            return this.totalLikes;
          }
        }
    }
</script>