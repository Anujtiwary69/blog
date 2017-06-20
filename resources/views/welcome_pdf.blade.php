@include("header")
<body class="hold-transition skin-blue sidebar-mini">
   
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <br>
        <br>

    
      <!-- //for css -->
        <!-- /table row stars -->

    <div class="row">
        <div class="col-sm-8 col-md-offset-2">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <td>
                            Image
                        </td>
                        <td>
                        Product Name
                        </td>
                        <td>
                            Product price
                        </td>
                        <td>
                            Seller
                        </td>
                    </tr>
                    <tbody>
                       
                        @foreach ($amazon as $user)
                            <tr>
                                <td>
                                   <img src="{{ $user['img']}}"> 
                                </td>
                                <td style=" word-wrap: break-word;">
                                {{$user['title']}}
                                </td>
                                <td>
                                    {{$user['price']}}
                                </td>
                                <td>
                                  {{$user['seller']}}
                                </td>
                            </tr>
                        @endforeach
                        @foreach ($ebay as $user)
                            <tr>
                                <td>
                                   <img src="{{ $user['img']}}"> 
                                </td>
                                <td style=" word-wrap: break-word;">
                                {{$user['title']}}
                                </td>
                                <td>
                                    {{$user['price']}}
                                </td>
                                <td>
                                  {{$user['seller']}}
                                </td>
                            </tr>
                        @endforeach
                       
                    </tbody>
                </thead>
            </table>
        </div>
    </div>
    
    @if($css!="stop")
        @include('jsFilesHref');
    @endif