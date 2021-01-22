<template>
  <select
    style="width: 100%"
    :id="id"
    :name="name"
    class="form-control kt-select2"
    :placeholder="placeholder"
    :disabled="disabled"
  >
    <option></option>
  </select>
</template>

<script>
import { Script } from "vm";
export default {
  name: "select-2",
  data() {
    return {
      select2: null,
      errors: null,
      bold: false,
      settings: {
        placeholder: this.placeholder,
        id: function(bond) {
          return bond._id;
        },
        ajax: {
          url: this.url,
          dataType: this.dataType,
          delay: this.delay,
          type: this.type,
          data: function(params) {
            var queryParameters = {
              q: params.term
            };
            return queryParameters;
          },
          processResults: function(res) {
            return {
              results: res
            };
          },
          cache: false
        },
        // allowClear: true,
        escapeMarkup: function(markup) {
          return markup;
        },
        minimumInputLength: this.minimumInputLength,
        minimumResultsForSearch: this.minimumResultsForSearch
      }
    };
  },
  model: {
    event: "change",
    prop: "value"
  },
  props: {
    disabled: {
      type: Boolean,
      default: false
    },
    required: {
      type: Boolean,
      default: false,
      required: false
    },
    url: {
      type: String,
      default: "",
      required: true
    },
    rules: {
      type: String,
      required: false
    },
    selected: {
      type: Object
    },
    id: {
      type: String,
      default: "",
      required: false
    },
    name: {
      type: String,
      default: "",
      required: false
    },
    placeholder: {
      type: String,
      default: "Silahkan input lalu pilih . . .",
      required: false
    },
    minimumInputLength: {
      type: Number,
      default: 1,
      required: false
    },
    minimumResultsForSearch: {
      type: Number,
      default: 20,
      required: false
    },
    dataType: {
      type: String,
      default: "json",
      required: false
    },
    type: {
      type: String,
      default: "GET",
      required: false
    },
    textStyle: {
      type: String,
      default: "normal",
      required: false
    },
    descStyle: {
      type: String,
      default: "normal",
      required: false
    },
    delay: {
      type: Number,
      default: 250,
      required: false
    },
    cache: {
      type: Boolean,
      default: false,
      required: false
    }
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
        if (val.hasOwnProperty("id") && val.hasOwnProperty("text")) {
          if(val.text != "null" && val.text != null) {
            let opt = new Option(val.text, val.id, true, true);

            $(this.$el).append(opt);

            $(this.$el).trigger({
              type: "select2:select",
              params: {
                data: {
                  id: val.id,
                  text: val.text,
                  selected: true
                },
                _type: "select"
              }
            });
          }
        }
      }
    }
  },
  mounted() {
    let s2 = this;
    this.select2 = $(this.$el)
      .select2({
        ...this.settings,
        data: this.options,
        templateResult: function(data) {
          if (data.loading) {
            return data.text;
          }

          let text = "";
          let image = "";
          let desc = "";

          if (data.hasOwnProperty("text")) {
            let textStyle = {
              pre: "",
              post: "",
              content: data.text
            };

            if (s2.textStyle === "bold") {
              textStyle.pre = "<b>";
              textStyle.post = "</b>";
            }

            text =
              "<td>" +
              textStyle.pre +
              textStyle.content +
              textStyle.post +
              "</td>";
          }

          if (data.hasOwnProperty("image")) {
            image =
              "<td rowspan='2' style='padding-right:5px;'><img width='50px' src='" +
              data.image +
              "'/></td>";
          }

          if (data.hasOwnProperty("desc")) {
            let descStyle = {
              pre: "",
              post: "",
              content: data.desc
            };

            if (s2.descStyle === "italic") {
              descStyle.pre = "<i>";
              descStyle.post = "</i>";
            }

            desc =
              "<td>" +
              descStyle.pre +
              descStyle.content +
              descStyle.post +
              "</td>";
          }

          const $container = $(
            "<div style='padding-left:0px;'><table><tr>" +
              image +
              text +
              "</tr><tr>" +
              desc +
              "<tr></table></div>"
          );

          return $container;
        },
        templateSelection: function(data, container) {
          Object.keys(data).forEach(key => {
            let block = [
              "_resultId",
              "id",
              "element",
              "selected",
              "disabled",
              "text",
              "title"
            ];

            if (!block.includes(key)) {
              let value = "" + data[key];
              let attribute = "data-" + key.replace("_", "-");

              $(data.element).attr(attribute, value);
            }
          });
          return data.text;
        },
        language: {
          errorLoading: function() {
            return "Tidak ada data ditemukan.";
          },
          inputTooLong: function(args) {
            var overChars = args.input.length - args.maximum;

            return "Hapuskan " + overChars + " huruf";
          },
          inputTooShort: function(args) {
            var remainingChars = args.minimum - args.input.length;

            return "Ketikkan " + remainingChars + " huruf atau lebih";
          },
          loadingMore: function() {
            return "Mengambil data…";
          },
          maximumSelected: function(args) {
            return "Anda hanya dapat memilih " + args.maximum + " pilihan";
          },
          noResults: function() {
            return "Tidak ada data yang sesuai";
          },
          searching: function() {
            return "Melakukan pencarian…";
          },
          removeAllItems: function() {
            return "Hapus semua item";
          }
        }
      })
      .on("select2:select select2:unselect", ev => {
        if (ev.hasOwnProperty("params")) {
          this.$emit("change", this.select2.val());
          this.$emit("select", ev["params"]["data"]);
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
