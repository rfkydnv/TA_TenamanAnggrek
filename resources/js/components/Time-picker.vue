<template>
    <div class="input-group"> 
        <div class="input-group-prepend"> 
            <span class="input-group-text"> 
                <i class="la la-clock-o"></i> 
            </span> 
        </div>
        <input type="text" class="form-control time-picker" placeholder="Silahkan pilih waktu . . ." :value="time" :id="id" :disabled="disabled"/> 
    </div>
</template>

<script>
import { Script } from 'vm'
  export default {
    name: 'time-picker',
    data(){
      return{
        content:this.val
      }
    },
    props: ['val','time','id','disabled'], 
    watch : {
      content: function (newContent,oldContent) {
      } 
    },
    mounted(){
      var vm = this;
        $('#'+vm.id).timepicker({
          autoclose:true,
          timeFormat: 'HH:mm:ss',
          minuteStep: 1,
          defaultTime: '',
          showSeconds: true,
          showMeridian: false,
          snapToStep: true
        })
        .on('changeTime.timepicker', function(e) {
          vm.$emit('input', e.time.value);
        });
    }
  }
  </script>
