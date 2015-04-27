$("body").on("click", ".sign-in-btn-nav", function(){
	var content = 	"<div class = 'cover-window-shell'></div>" +
					"<div class = 'sign-in-window-container show-up-window-container'>" +
					"<div class = 'panel panel-default sign-in-window'>" +
					"<div class = 'panel-heading'><h2 class = 'panel-title'>Sign-in<span class = 'glyphicon glyphicon-remove text-danger close-window' style = 'cursor:pointer; float:right'></span></h2></div>" +
					"<div class = 'panel-body'>" +
					"<div class = 'alert-insert-here'><br/></div>" +
					"<div class = 'input-group'>" +
					"<span class = 'input-group-addon'>Email address</span>" +
					"<input type = 'text' class = 'form-control' placeholder = 'user@user.com' aria-describedby = 'basic-addon1' name = 'email'>" +
					"</div>" +
					"<div class = 'input-group'>" +
					"<span class = 'input-group-addon'>Password</span>" +
					"<input type = 'password' class = 'form-control' placeholder = 'password' aria-descrbedby = 'basic-addon1' name = 'password'>" +
					"</div>" +
					"<br/>" +
					"No account? <a class = 'register-start-btn cursor-pointer'>Sign Up</a> now and join us!" +
					"<button class = 'btn btn-success btn-sign-in-form-submit'>Sign In</button>" +
					"</div>" +
					"</div>" +
					"</div>";
	$("body").append(content);
	$("div.sign-in-window-container").fadeIn();
});
$(".sign-out-btn-nav").click(function(){
	$.ajax({
		type: "GET",
		url: "ajax_handler.php",
		data: {signout:"sign out"}
	}).done(function(data){
		window.location.href = data;
	})
})

function validate_phone(k){
	if($("#phone").val().length != 10)
		return false;
	for(var i = 0; i < $("#phone").val().length; i++)
		if($("#phone").val()[i] < "0" || $("#phone").val()[i] > "9"){
			console.log($("#phone").val()[i]);
			return false;
		}
	return true;
}

$("document").ready(function(){
	$("body").on("click", ".close-window", function(){
		$("div.cover-window-shell").remove();
		$("div.show-up-window-container").fadeOut(function(){
			$("div.show-up-window-container").remove();
		})
	}).on("click", ".btn-sign-in-form-submit", function(){
		$(".alert-insert-here").html("<br/>");
		$.ajax({
			type: "POST",
			url: "ajax_handler.php",
			data: {email:$("input[name=email]").val(), password:$("input[name=password]").val(), operation:"login"}
		}).done(function(data){
			console.log(data)
			if(data == 1){
				$("input[name=email]").attr("disabled", "true");
				$("input[name=password]").attr("disabled", "true");
				$("button.btn-sign-in-form-submit").attr("disabled", "true");
				location.reload();
			} else if(data == -1){
				$(".alert-insert-here").html(
					"<div class = 'alert alert-danger alert-notice-not-match' role = 'alert' style = 'display:none'>" +
					"<span class = 'glyphicon glyphicon-exclamation-sign' aria-hidden = 'true'></span>" +
					"<span class = 'sr-only'>Error:</span>" +
					"Your password is not correct or the account does not exist" +
					"</div>"
				)
				$(".alert-notice-not-match").fadeIn();
			}
		})
	}).on("click", ".register-start-btn", function(){
		$(".sign-in-window-container").remove();
		$(".cover-window-shell").remove();
		var content = "<div class = 'cover-window-shell'></div>" +
					"<div class = 'sign-up-window-container show-up-window-container'>" +
					"<div class = 'panel panel-default sign-in-window'>" +
					"<div class = 'panel-heading'><h2 class = 'panel-title'>Sign Up<span class = 'glyphicon glyphicon-remove text-danger close-window' style = 'cursor:pointer; float:right'></span></h2></div>" +
					"<div class = 'panel-body'>" +
					"<div class = 'alert-window alert alert-success' role = 'alert'>Welcome to join us!</div>" +
					"<div class = 'form-horizontal'>" +
					//"<form action = 'test.php' method = 'get'>" +
					"<div class='form-group'>" +
					"<label for='email' class='col-sm-2 control-label'>Email</label>" +
					"<div class='col-sm-10'>" +
					"<input type='email' class='form-control' id='email' placeholder='Email e.g. rtp@sina.com' name = 'email' required>" +
					"</div>" +
					"</div>" +
					"<div class='form-group'>" +
					"<label for='fname' class='col-sm-2 control-label'>First Name</label>" +
					"<div class='col-sm-10'>" +
					"<input type='text' class='form-control' id='fname' placeholder='Your first name e.g. John' name = 'fname'>" +
					"</div>" +
					"</div>" +
					"<div class='form-group'>" +
					"<label for='lname' class='col-sm-2 control-label'>Last Name</label>" +
					"<div class='col-sm-10'>" +
					"<input type='text' class='form-control' id='lname' placeholder='Your last name e.g. Smith' name = 'lname'>" +
					"</div>" +
					"</div>" +
					"<div class='form-group'>" +
					"<label for='phone' class='col-sm-2 control-label'>Phone Number</label>" +
					"<div class='col-sm-10'>" +
					"<input type='text' class='form-control' id='phone' placeholder='Phone number e.g. 8888888888' name = 'phone'>" +
					"</div>" +
					"</div>" +
					"<div class='form-group'>" +
					"<label for='password' class='col-sm-2 control-label'>Password</label>" +
					"<div class='col-sm-10'>" +
					"<input type='password' class='form-control' id='password' placeholder='Your password' name = 'password'>" +
					"</div>" +
					"</div>" +
					"<div class='form-group'>" +
					"<label for='password2' class='col-sm-2 control-label'>Password</label>" +
					"<div class='col-sm-10'>" +
					"<input type='password' class='form-control' id='password2' placeholder='Retype the password' name = 'password2'>" +
					"</div>" +
					"</div>" +
					"<button type = 'button' class = 'btn btn-primary sign-up-submit'>Sign Up</button>" +
					//"</form>" +
					"</div>" +
					"</div>" +
					"</div>" +
					"</div>";
		$("body").append(content);
		$("div.sign-up-window-container").fadeIn();
	}).on("click", ".sign-up-submit", function(){
		var tmp = $("#email").val().split("@");
		if($("#email").val() == ""){
			if(!$(".alert-window").hasClass("alert-danger"))
				$(".alert-window").removeClass("alert-success").addClass("alert-danger")
			$(".alert-window").html("Please enter an email address");
			$("#email").focus();
		} else if(tmp.length != 2 || (tmp[1].split(".")).length < 2){
			if(!$(".alert-window").hasClass("alert-danger"))
				$(".alert-window").removeClass("alert-success").addClass("alert-danger")
			$(".alert-window").html(
				"An valid email address should be provided."
			)
			$("#email").focus();
		} else if($("#fname").val() == "" || $("#lname").val() == ""){
			if(!$(".alert-window").hasClass("alert-danger"))
				$(".alert-window").removeClass("alert-success").addClass("alert-danger")
			$(".alert-window").html("Please enter your name");
			if($("#fname").val() == "")
				$("#fname").focus()
			else $("#lname").focus()
		} else if($("#phone").val() != "" && !validate_phone($("#phone").val())){
			if(!$(".alert-window").hasClass("alert-danger"))
				$(".alert-window").removeClass("alert-success").addClass("alert-danger")
			$(".alert-window").html("The phone number is invalid");
			$("#phone").focus()
		} else if($("#password").val() == ""){
			if(!$(".alert-window").hasClass("alert-danger"))
				$(".alert-window").removeClass("alert-success").addClass("alert-danger")
			$(".alert-window").html("Please enter your password");
			$("#password").focus()
		} else if($("#password").val().length < 6 || $("#password").val().length > 25){
			if(!$(".alert-window").hasClass("alert-danger"))
				$(".alert-window").removeClass("alert-success").addClass("alert-danger")
			$(".alert-window").html("The length of password should be between 6 and 25");
			$("#password").focus()
		} else if($("#password").val() != $("#password2").val()){
			if(!$(".alert-window").hasClass("alert-danger"))
				$(".alert-window").removeClass("alert-success").addClass("alert-danger")
			$(".alert-window").html("Passwords do not match, please retype your password");
			$("#password2").focus()
		} else {
			if($(".alert-window").hasClass("alert-danger"))
				$(".alert-window").removeClass("alert-danger").addClass("alert-success")
			$(".alert-window").html("Welcome to join us!")
			$.ajax({
				url: "ajax_handler.php",
				type: "POST",
				data:{operation:"register", email: $("#email").val(), fname: $("#fname").val(), lname: $("#lname").val(), password: $("#password").val(), phone: $("#phone").val()},
				success: function(data){
					console.log(data)
					if(data == "-1"){
						if(!$(".alert-window").hasClass("alert-danger"))
							$(".alert-window").removeClass("alert-success").addClass("alert-danger")
						$(".alert-window").html("Account already exists");
						$("#email").focus()
					} else if(data == 1){
						location.reload();
					}
				}
			})
		}
	})
})


