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
<div class="row">
    <!--display Trip journal col-->
    <div class="col-md-6"><h2>Trip Journals</h2><hr>
<?php
        $query_journal = "SELECT * FROM travelJournal WHERE journal_status = 1 ORDER BY journal_timestamp DESC LIMIT 20";
        $result = mysql_query($query_journal,$conn) or die(mysql_error());
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
            <h3><?php echo $journal_title; ?></h3>
            <h4><?php echo $user_name; ?></h4>
            <p><?php echo $journal_timestamp; ?></p>

            <p class="myPara"><?php echo $journal_content; ?></p>
            <a class="btn btn-primary" href="">View <span class="glyphicon glyphicon-chevron-right"></span></a>
            <hr>
<?php
        }
?>
    </div>

    <!--display trip plan col-->
    <div class="col-md-3"><h2>Trip Plans</h2><hr>
<?php
        $query_trip = "SELECT * FROM tripPlan ORDER BY trip_last_updated DESC LIMIT 20";
        $result = mysql_query($query_trip,$conn) or die(mysql_error());
        while ($line = mysql_fetch_assoc($result)) 
        {
            $trip_title = $line['trip_title'];
            $trip_id = $line['id'];
            $trip_startaddress = $line['trip_startaddress'];
            $trip_endaddress  = $line['trip_endaddress'];
?>
            <h4><?php echo $trip_title; ?></h4>
            <p><?php echo $trip_startaddress." -> ".$trip_endaddress; ?></p> 
            <hr>
<?php
        }
?>   
    </div>

    <!--display QA col-->
    <div class="col-md-3"><h2>Q/As</h2><hr>
<?php
        $query_question = "SELECT * FROM question ORDER BY question_timestamp DESC LIMIT 20";
        $result = mysql_query($query_question,$conn) or die(mysql_error());
        while ($line = mysql_fetch_assoc($result)) 
        {
            $question_id= $line['id'];
            $question_text = $line['question_text'];
           
?>
            
            <p class="myquestion"><?php echo $question_text; ?></p> 
            <hr>
<?php
        }
?>   
    </div>
</div>
<?php
}
?>
</div> <!--container div end-->


<?php include '../templates/footer.html'; ?>

<script type="text/javascript">
    //charactors limit for journal detail
    $(function() {
        var limit = 270;
        for (var i = 0; i < $(".myPara").length; i++)
        {
            var chars = $(".myPara").eq(i).text(); 
            if (chars.length > limit) {
                var visiblePart = $("<span> "+ chars.substr(0, limit-1) +"</span>");
                var dots = $("<span class='dots'>... </span>");

                $(".myPara").eq(i).empty()
                    .append(visiblePart)
                    .append(dots);
            }
        }
    });

    //charactors limit for question
    $(function() {
        var limit = 200;
        for (var j = 0; j < $(".myquestion").length; j++)
        { 
            var chars = $(".myquestion").eq(j).text(); 
            if (chars.length > limit) {
                var visiblePart = $("<span> "+ chars.substr(0, limit-1) +"</span>");
                var dots = $("<span class='dots'>... </span>");

                $(".myquestion").eq(j).empty()
                    .append(visiblePart)
                    .append(dots);
            }
        }
    });
</script>


