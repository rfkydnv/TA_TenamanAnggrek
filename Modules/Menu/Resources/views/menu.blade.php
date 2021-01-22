@extends('template.layout')

@section('app_title',env('APP_NAME'))

@section('module_title',$module_title)

@section('css')
    <style>
        div.sc
        {
            overflow: auto
        }
    </style>
    @stop

@section('container')
    <!-- begin:: Content -->

    <div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid" id="my-vue">
        <div class="form-group" row>
            <validation-observer v-slot="{ passes }" >

                <div class="row">
                    <div class="col-lg-12">
                        <div class="kt-portlet">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                       {{ $form_title }}
                                    </h3>
                                </div>
                            </div>

                            <form @submit.prevent="passes(action_form)"
                                  id="my-form"
                                  action="{{ @$action }}"
                                  action-type="{{ @$action_type }}"
                                  data-url="{{ @$getdata }}">
                                {{ csrf_field() }}

                                <div class="kt-portlet__body">
                                    <div class="row">
                                        <div class="col-md-12 form-warning" style="display:none">
                                            @include('template.alert')
                                        </div>
                                        <div class="col-md-4">
                                            <div class="col-md-12">
                                                <div class="kt-section kt-section--first">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <validation-provider name="menu_parentid" rules="">
                                                                <div slot-scope="{ errors }">
                                                                    <label>Parent Menu </label>
                                                                    <select-2-url v-model="form.menu_parentid" :selected="{{json_encode(@$menu)}}" url="{{ route('menu.select2') }}" />
                                                                    <p>@{{ errors[0] }}</p>
                                                                </div>
                                                            </validation-provider>
                                                        </div>

                                                        <div class="form-group">
                                                            <validation-provider name="menu_name" rules="required">
                                                                <div slot-scope="{ errors }">
                                                                    <label>Menu</label>
                                                                    <input type="text" v-model="form.menu_name" class="form-control">
                                                                    <p>@{{ errors[0] }}</p>
                                                                </div>
                                                            </validation-provider>
                                                        </div>

                                                        <div class="form-group">
                                                            <validation-provider name="menu_link" rules="">
                                                                <div slot-scope="{ errors }">
                                                                    <label>Menu Link</label>
                                                                    <input type="text" v-model="form.menu_link" class="form-control">
                                                                    <p>@{{ errors[0] }}</p>
                                                                </div>
                                                            </validation-provider>
                                                        </div>

                                                        <div class="form-group ">
                                                            <label>Menu Icon</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text target-icon" id="basic-addon2">
                                                                        <i class="flaticon-refresh"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" id="menu_icon" v-model="form.menu_icon" class="form-control" placeholder="flaticon-refresh" readonly aria-describedby="basic-addon2">
                                                                <div class="input-group-append">
                                                                    <button type="button"
                                                                            class="btn btn-secondary btn-bold btn-label-brand btn-sm"
                                                                            data-toggle="modal" data-target="#kt_modal_1_2">
                                                                        Pilih Icon
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                     {{--<div class="form-group">--}}
                                                            {{--<label class=""> Menu Icon </label>--}}
                                                            {{--@php--}}
                                                                {{--$fa = font_awesome();--}}
                                                            {{--@endphp--}}
                                                            {{--<select class="form-control kt-selectpicker" multiple title="Auto" id="kt_select2_2">--}}
                                                                {{--@foreach($fa as $kf => $vf)--}}
                                                                    {{--<option value="{{ $kf }}" data-icon="{{ $kf }}"> {{ $vf }} </option>--}}
                                                                {{--@endforeach--}}
                                                            {{--</select>--}}
                                                        {{--</div>--}}


                                                    </div>
                                                </div>
                                                <div class="kt-form__actions">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-primary"> {{ @$action_type == "add" ? " Tambah Menu" : "Update" }} </button>
                                                        <a href="{{ route("menu.index") }}" class="btn btn-secondary myredirect" style="display:none">Kembali</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                           <div class="col-md-12">
                                               <div class="dd" id="nestable">
                                                   {{ generate_menu() }}
                                               </div>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </validation-observer>
        </div>

        <!--begin::Modal-->
        <div class="modal fade"
             id="kt_modal_1_2"
             tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body" id="app">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="kt-portlet__body">

                                    <!--begin: Search Form -->
                                    <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                                        <div class="row align-items-center">
                                            <div class="col-xl-12 order-2 order-xl-12">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12 kt-margin-b-20-tablet-and-mobile">
                                                        <div class="kt-input-icon kt-input-icon--left">
                                                            <input type="text" v-model="search" class="form-control" placeholder="Search..." id="generalSearch">
                                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
																<span><i class="la la-search"></i></span>
															</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--end: Search Form -->
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="kt-portlet__body kt-portlet__body--fit">
                                    <div class="kt-scroll" data-scroll="true" data-height="500">
                                        <div class="row" v-for="post in filteredList" style="padding:3pt">
                                            <div class="col-md-3" v-for="example in post.title">
                                                <div class="kt-demo-icon" v-on:click="get_icon(example)" style="cursor:pointer">
                                                    <div class="kt-demo-icon__preview">
                                                        <i :class="example"></i>
                                                    </div>
                                                    <div class="kt-demo-icon__class">
                                                        @{{ example }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Datatable -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary my-modal"  data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Modal-->
    </div>


    <!--end::Modal-->
        @stop

        @section("script")
            <script type="text/javascript">

                $( document ).ready(function() {
                         CoreFormControls.handleAction();

                        class Icon {
                            constructor(title, id) {
                                this.title = title;
                                this.id = id;
                            }
                        }

                        const app = new Vue ({
                            el: '#my-vue',
                            data: {
                                search: '',
                                postList: [],
                                form: {array:[]},
                                errors: null
                            },
                            methods: {
                                get_icon: function (value)
                                {
                                    var target_li = $(".target-icon");
                                    this.form.menu_icon = value;
                                    target_li.html('<i class="' + value + '"></i>');

                                    if($('.my-modal').length)
                                    {
                                        $('.my-modal')[0].click();
                                    }
                                },
                                action_form()
                                {
                                    var form_       = $("#my-form");
                                    var action      = form_.attr('action');
                                    var warning     = $('.form-warning');

                                    warning.hide();

                                    Swal.fire({
                                        title: 'Apakah Anda Yakin?',
                                        text: "Pastikan data yang di masukan telah benar",
                                        type: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#75d61f',
                                        cancelButtonColor: '#4b60dd',
                                        confirmButtonText: 'Yes, Simpan Data!'
                                    }).then((result) => {
                                        if (result.value) {
                                            CoreFormControls.blockUI();
                                            axios.post(action, this.form)
                                                .then((res)=>{
                                                    CoreFormControls.unblockUI();
                                                    CoreFormControls.customToast();
                                                    toastr.success(res.data.message, "Sukses");
                                                    if($('.myredirect').length){
                                                        $('.myredirect')[0].click();
                                                    }
                                                })
                                                .catch((err)=>{
                                                    CoreFormControls.unblockUI();
                                                    if (err.response.status == 422) this.errors = err.response.data.errors;
                                                    CoreFormControls.showWarn();
                                                    CoreFormControls.customToast();
                                                    toastr.error("Gagal Memproses Data!", "Gagal");

                                                })
                                        }
                                    })
                                }
                            },
                            computed: {
                                filteredList() {
                                    var matcher = new RegExp(this.search, 'i');
                                    return this.postList.filter(function(post){
                                        return matcher.test(post.title)
                                    })
                                },
                                filterMenu(){
                                    var matcher = new RegExp(this.search, 'i');
                                    return this.postList.filter(function(post){
                                        return matcher.test(post.title)
                                    })
                                }
                            },
                            mounted:function ()
                            {
                                let $vm = this;
                                var urlIcon = '{{ route("menu.getIcon") }}';
                                let myform = $("#my-form");
                                let url = myform.attr('data-url');
                                let action = myform.attr('action-type');

                                var myarray = ['edit', 'lihat', 'update'];

                                axios.get(urlIcon)
                                .then(function (resp)
                                {
                                    $.each(resp.data.data, function(index, val)
                                    {
                                        $vm.postList.push(
                                            new Icon(val,index)
                                        );
                                    });

                                })
                                .catch(function (err) {
                                    console.log(err);
                                });


                                if (jQuery.inArray(action.toLowerCase(), myarray) != '-1')
                                {
                                    axios.get(url)
                                        .then(function (resp)
                                        {
                                            let _temp = $vm.$data.form;
                                            $vm.$data.form = resp.data;

                                            Object.keys(_temp).forEach((key) => {
                                                $vm.$data.form[key] = _temp[key];
                                            });

                                            // set icon
                                            var target_li = $(".target-icon");
                                            target_li.html('<i class="' + resp.data.menu_icon + '"></i>');

                                            App.unblockUI();
                                        })
                                        .catch(function (err) {
                                            CoreFormControls.customToast();
                                            toastr.error("Gagal Mengambil Data!", "Gagal");
                                            App.unblockUI();
                                        });
                                }
                            }
                        });
                });
            </script>
@stop