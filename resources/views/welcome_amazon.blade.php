<div class="row" style="" id="tabledata">
        <div class="col-sm-10 col-md-offset-1">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <td>
                            Sr.no
                        </td>
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
                        <td>
                        description
                        </td>
                    </tr>
                    <tbody>
                
                        
                       @foreach ($amazon as $user)

                    
                        
                        <tr>
                            <td>{{$i+=1}} </td>

                            <td>
                               <img src="{{ $user->image}}"> 
                            </td>
                            <td style=" word-wrap: break-word;">
                            {{$user->name}}
                            </td>
                            <td>
                                {{$user->price}}
                            </td>
                            <td>
                              {{$user['seller']}}
                            </td>
                            <td>
                              {{$user['des']}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tbody>
                       
                    </tbody>
                    
                </thead>
            </table>
        </div>
    </div>