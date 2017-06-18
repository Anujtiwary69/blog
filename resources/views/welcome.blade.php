@include ('header')
    <div class="clearfix"></div>

    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="">
                    <div class="clearfix"></div>
                    <br>
                    <div class="">
                        <form action="<?php  echo url('/search');?>" method="post">
                            <input type="text" name="search" class="form-control" placeholder="Search for...">
                            {{ csrf_field() }}
                            <br>
                            <br>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" style="float: right;" >Go!</button>
                            </span>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- /table row stars -->
        <div class="row">
            <table class="table table-striped">
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