@include("header")
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('nav')
    @include('sidebar')
   
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
         <div class="col-md-8 col-md-offset-2"> 
         @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <br>
        <br>
          <form action="<?Php echo url('/aproject');?>" method="post">
  <div class="form-group" >
    <label for="exampleInputEmail1">Project Name</label>
    <input type="text" class="form-control" name="pname" placeholder="Apple search" required="">
    {{ csrf_field() }}
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Keyword</label>
    <input type="text" class="form-control" name="pkeyword" placeholder="Iphone" required="">
  </div>
  <div class="form-group">
    <label for="exampleTextarea">Project Description</label>
    <textarea class="form-control" id="exampleTextarea" name="des" rows="3" required=""></textarea>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
        </div>