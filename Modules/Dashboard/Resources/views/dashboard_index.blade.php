@extends('template.layout')

@section('app_title',env('APP_NAME'))

@section('module_title',$module_title)

@section('container')
{{-- <div class="kt-portlet"> --}}
    <div class="kt-portlet__body" id="my-vue">
        <validation-observer v-slot="{ passes }" >
           

            <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-primary" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#kt_tabs_6_1" role="tab">Sales Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_tabs_6_3" role="tab">Gudang</a>
                </li>
            </ul>
            <div class="kt-separator"></div>
            <div class="tab-content">
                <div class="tab-pane active" id="kt_tabs_6_1" role="tabpanel">
                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__body">
                            <div class="kt-section row">
                                <div class="kt-section__content kt-section__content--solid col-md-3">
                                    <h4 class="text-center">TOTAL ARTIKEL</h4>
                                    <h3 class="text-center">@{{ totalData.totalDataSales }}</h3>
                                </div>
                                
                                <div class="kt-section__content kt-section__content--solid col-md-3">
                                    <h4 class="text-center">TOTAL ANGGREK</h4>
                                    <h3 class="text-center">@{{ totalData.totalDataAnggrek }}</h3>
                                </div>
                            </div> 
                            <div class="kt-section row">
                            </div> 
                        </div>

                    </div>
                    
                </div>
                <div class="tab-pane" id="kt_tabs_6_2" role="tabpanel">
                    It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
                <div class="tab-pane" id="kt_tabs_6_3" role="tabpanel">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged
                </div>
            </div>
        </validation-observer>
    </div>
{{-- </div> --}}
@stop
@section("script")
    <script type="text/javascript">  
    KTUtil.ready(function() {
            var $mixin = {
            data() {
                return {
                    form : {
                            tgl_awal: '{{ @$dateAwal }}',
                            tgl_akhir: '{{ @$dateAkhir }}',
                        },
                    totalData : {},
                    produkNama : [],
                    
                }
            },
            methods:{
                filter: () =>{
                    let tglawal = $("#tglawal").val();
                    let tglakhir = $("#tglakhir").val();
                    let params = "?tglawal="+tglawal+"&tglakhir="+tglakhir;
                    axios.get(`/dashboard/getartikel`+params).then((res) => {
                        $vm.totalData = res.data;
                    });
                }
            },
            mounted() {
                axios.get(`/dashboard/getartikel`).then((res) => {
                        $vm.totalData = res.data;
                        $vm.produkNama = res.data.produkNama;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }
        }
        CoreFormControls.init($mixin);
    });
    </script>
@stop
