@include ('header')
    <div class="clearfix"></div>

    <div class="container">
        @if(!empty($ebay))
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
                       
                        @foreach ($amazon as $user)
                            <tr>
                                <td>
                                {{$user['img']}}
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
                                   {{$user['img']}}
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
    @endif