<?php include '../templates/header.html'; ?>

<style type="text/css">
    #imagestyle {
        width:440px;
        height:250px

    }
</style><!-- Custom Fonts CSS -->

<?php include '../templates/navbar.html'; ?>


<div class="container">
  <div class="row">
        <div class="col-md-6">
        <h2>Find Your Trip/Travel Journal</h2>
            
            <form method="POST" action="">
            <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text" name="search" class="form-control input-lg" placeholder="Search Anything" />
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
            </form>

        </div>
  </div>
  <hr>

<?php if(isset($_POST['search']))
{
?>
  <!-- Project One -->
        <div class="row">
            <div class="col-md-7">
                <a href="">
                    <img class="img-responsive" src="" alt="" id = "imagestyle">
                </a>
            </div>
            <div class="col-md-5">
                <h3>Searched Title</h3>
                <h4>Searched Cata</h4>
                <p>Searched PostDate</p>
                <p>Searched Author</p>
                <p>Searched Details</p>
                <a class="btn btn-primary" href="">View <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
        <!-- /.row -->
        <hr>
<?php
}

else{
?>
      <!-- Project One -->
        <div class="row">
            <div class="col-md-7">
                <a href="">
                    <img class="img-responsive" src="" alt="" id = "imagestyle">
                </a>
            </div>
            <div class="col-md-5">
                <h3>Default Title</h3>
                <h4>Default Cata</h4>
                <p>Default PostDate</p>
                <p>Default Author</p>
                <p>Default Details</p>
                <a class="btn btn-primary" href="">View <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
        <!-- /.row -->
        <hr>
<?php
}
?>
</div>


<?php include '../templates/footer.html'; ?>