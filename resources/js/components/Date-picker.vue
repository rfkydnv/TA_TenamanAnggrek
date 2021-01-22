<template>
    <div class="input-group date"> 
        <div class="input-group-append"> 
            <span class="input-group-text"> 
                <i class="la la-calendar"></i> 
            </span> 
        </div>
        <input readonly="" type="text" data-date-today-highlight="true" class="form-control" placeholder="Silahkan pilih . . ." :value="date" :id="id" :disabled="disabled"/>
    </div>
</template>

<script>
import { Script } from 'vm'
  export default {
    name: 'date-picker',
    data(){
      return{
        content:this.val
      }
    },
     props: {
      disabled: {
        type: Boolean,
        default: false
      },
      required: {
        type: Boolean,
        default: false,
        required: false,
      },
      val: {
        type: String,
        default: '',
      },
      id: {
        type: String,
        default: '',
      },
      date: {
        type: String,
        default: '',
      },
      format: {
        type: String,
        default: 'dd-mm-yyyy',
      },
      picker: {
        type: String,
        default: '',
      }
     },
    watch : {
      content: function (newContent,oldContent) {
      } 
    },
    mounted(){
      var vm = this;
        $('#'+vm.id).datepicker({
            autoclose:true,
            format: vm.format,
            minViewMode: vm.picker,
        }).on('changeDate',function (e) {
            vm.$emit('input', e.format(0));
        })
    }
  }
  </script>
