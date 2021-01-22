<template>
    <div class="input-group">
    <div class="input-group-append"> 
        <span class="input-group-text"> 
            <i class="la la-calendar"></i> 
        </span> 
    </div>  
  <input type="tel" class="form-control"  v-model="content" v-mask="'##-##-####'" :placeholder="val?val:'dd-mm-yyyy'"  @input="handleInput"/>
    </div>
</template>

<script>
import { Script } from 'vm'
import {mask} from 'vue-the-mask'
  export default {
    name: 'date-mask',
    methods:{
        handleInput (e) {
        this.$emit('input', this.content);
      }
    },
    data(){
      return{
        content:this.val
      }
    },
    props: ['val'], 
    directives: {
      mask
    },
    watch : {
      content: function (newContent,oldContent) {
      } 
    },
    // mounted(){
    //   console.log(this.xyz);
    //   this.content = "11-10-2019"

    //   console.log(this)

    // }
  }
  </script>