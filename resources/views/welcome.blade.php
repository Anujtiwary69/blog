@include ('header')
    <div class="clearfix"></div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="">
                    <div class="clearfix"></div>
                    <br>
                    <div class="input-group">
                        <form action="<?php  echo url('/search');?>" method="post">
                            <input type="text" name="search" class="form-control" placeholder="Search for...">
                            {{ csrf_field() }}
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" >Go!</button>
                            </span>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>