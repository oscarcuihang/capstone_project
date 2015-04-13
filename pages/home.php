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
        <h2>Find a ...</h2>
            
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
  
  $query = "SELECT * FROM travelJournal";
  $result = mysql_query($query,$conn) or die(mysql_error());
  //$total_num = mysql_num_row($result);

  
      while ($line = mysql_fetch_assoc($result)) 
      {
        $journal_title = $line['journal_title'];
        $journal_timestamp = $line['journal_timestamp'];
        $journal_userid  = $line['journal_userid'];
        $journal_content  = $line['journal_content'];

        $query_user = "SELECT * FROM userInfo WHERE id = '$journal_userid'";
        $result_user = mysql_query($query_user,$conn) or die(mysql_error());
        $user_info = mysql_fetch_assoc($result_user);
        $user_name = $user_info['user_fname'] . " " . $user_info['user_lname'] ;
?>
        <div class="row">
            <div class="col-md-7">
                <a href="">
                    <img class="img-responsive" src="" alt="" id = "imagestyle">
                </a>
            </div>
            <div class="col-md-5">
                <h3><?php echo $journal_title; ?></h3>
                <h4><?php echo $user_name; ?></h4>
                <p><?php echo $journal_timestamp; ?></p>

                <p class="myPara"><?php echo $journal_content; ?></p>
                <a class="btn btn-primary" href="">View <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
        <hr>
<?php
      }

}

?>
</div>


<?php include '../templates/footer.html'; ?>


<script type="text/javascript">
    $(function() {
        var limit = 270;
        var chars = $(".myPara").text(); 
        if (chars.length > limit) {
            var visiblePart = $("<span> "+ chars.substr(0, limit-1) +"</span>");
            var dots = $("<span class='dots'>... </span>");

            $(".myPara").empty()
                .append(visiblePart)
                .append(dots);
        }
    });
</script>


