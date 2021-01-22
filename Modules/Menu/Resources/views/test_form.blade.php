@extends('template.layout')

@section('app_title',env('APP_NAME'))

@section('module_title',$module_title)

@section('container')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div id="app">
            <div class="search-wrapper">
                <input type="text" v-model="search" placeholder="Search title.."/>
                <label>Search title:</label>
            </div>
            <div class="wrapper">
                <div class="row" v-for="post in filteredList" style="padding:3pt">
                    <div class="col-md-2" v-for="example in post.title">
                        <div class="kt-demo-icon">
                            <div class="kt-demo-icon__preview">
                                <i :class="example"></i>
                            </div>
                            <div class="kt-demo-icon__class">
                                @{{ example }}</div>
                        </div>
                    </div>
                </div>

                    {{-- <div class="col-md-3" v-for="example in post.title" style="padding:2pt">
                         <a href="javascript:;"
                            style="cursor: pointer; text-align: center"
                            class="tooltip-test"
                            data-toggle="kt-tooltip"
                            data-turbolink="false"
                            title="pilih">
                             <div class="kt-demo-icon">
                                 <div class="kt-demo-icon__preview">
                                     <i :class="example"></i>
                                 </div>
                             </div>
                         </a>
                     </div>--}}

            </div>
        </div>

        <!--end::Modal-->
    </div>
@stop

@section("script")

    <script type="text/javascript">
        class Post {
            constructor(title, id) {
                this.title = title;
                this.id = id;
            }
        }

        $( document ).ready(function() {


            const app = new Vue ({
                el: '#app',
                data: {
                    search: '',
                    postList : [
                        sublist=[]
                    ]
                },
                computed: {
                    filteredList() {
                        var matcher = new RegExp(this.search, 'i');
                        return this.postList.filter(function(post){
                            return matcher.test(post.title)
                        })

                        /*return this.postList.filter(post => {
                            return post.title.toLowerCase().includes(this.search.toLowerCase())
                        })*/
                    }
                },
                mounted:function ()
                {
                    let $vm = this;
                    var url = '{{ route("menu.getIcon") }}';
                    axios.get(url)
                        .then(function (resp)
                        {
                            $.each(resp.data.data, function(key, value)
                            {
                                $vm.postList.push(
                                    new Post(
                                        value,
                                        key,
                                    )
                                );
                            });
                        })
                        .catch(function (err) {
                                console.log("gagal");
                        });
                }
            })
            // CoreFormControls.init();
        });
    </script>
@stop