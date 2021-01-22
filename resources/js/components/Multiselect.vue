<template>
<!-- <validation-provider :name="name" :rules="rules">
    <div slot-scope="{ errors }"> -->
    <select :id="id" :name="name" class="form-control kt-select2" :placeholder="placeholder" :disabled="disabled" multiple="">
      <option></option>
    </select>
      <!-- <p>{{ errors[0] }}</p>
  </div>
</validation-provider> -->
</template>

<script>
import { Script } from 'vm'
  export default {
    name: 'multi-select',
    data() {
      return {
        select2: null,
        errors: null,
        settings: {
          placeholder: this.placeholder,
          id: function (bond) {
            return bond._id;
          },
          ajax: {
            url: this.url,
            dataType: this.dataType,
            delay: this.delay,
            type: this.type,
            data: function (params) {
              var queryParameters = {
                q: params.term
              };
              return queryParameters;
            },
            processResults: function (res) {
              return {
                results: $.map(res.data, function (obj) {
                  return {id: obj.id, text: obj.text};
                })
              }
            },
            cache: this.cache,
          },
          escapeMarkup: function (markup) {
            return markup;
          },
          minimumInputLength: this.minimumInputLength,
          minimumResultsForSearch: this.minimumResultsForSearch,
        },
      };
    },
    model: {
      event: 'change',
      prop: 'value'
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
      url: {
        type: String,
        default: '',
        required: true,
      },
      rules: {
        type: String,
        required: false,
      },
      selected: {
        type : Array,
      },
      id: {
        type: String,
        default: '',
        required: false,
      },
      name: {
        type: String,
        default: '',
        required: false,
      },
      placeholder: {
        type: String,
        default: 'Silahkan input lalu pilih . . .',
        required: false,
      },
      minimumInputLength: {
        type: Number,
        default: 1,
        required: false,
      },
      minimumResultsForSearch: {
        type: Number,
        default: 20,
        required: false,
      },
      dataType: {
        type: String,
        default: 'json',
        required: false,
      },
      type: {
        type: String,
        default: 'GET',
        required: false,
      },
      delay: {
        type: Number,
        default: 250,
        required: false,
      },
      cache: {
        type: Boolean,
        default: false,
        required: false,
      },
    },
    watch: {
      options(val) {
        this.setOption(val);
      },
      value(val) {
        this.setValue(val);
      }
    },
    methods: {
      setOption(val = []) {
        this.select2.empty();
        this.select2.select2({
          ...this.settings,
          data: val
        });
        this.setValue(this.value);
      },
      setValue(val) {
        if (val) {
          if (val[0].hasOwnProperty("id") && val[0].hasOwnProperty("text")) {
            val.forEach((e)=>{
              var opt = new Option(e.text, e.id, true, true);
             $(this.$el).append(opt);
              });
             $(this.$el).trigger({
              type: 'select2:select',
              params: {
                  data: {
                    id:val.id,
                    text:val.text,
                    selected:true
                  },
                  _type:'select'
              }
            });
          }
        }
      }
    },
    mounted() {
      this.select2 = $(this.$el)
        .select2({
          ...this.settings,
          data: this.options
        })
        .on('select2:select select2:unselect', ev => {
          if(ev.hasOwnProperty('params')){
          console.log(this.select2.val());
            this.$emit('change', this.select2.val());
            this.$emit('select', ev['params']['data']);
          }
        });

      this.setValue(this.selected);

    },
    beforeDestroy() {
      this.select2.select2('destroy');
    }
  };
</script>

<style scoped>

</style>