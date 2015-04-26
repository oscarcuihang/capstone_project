<?php include '../templates/header.html'; ?>
<?php include '../templates/navbar.html'; ?>

<script src="../../style/RichTextEditor/ckeditor.js"></script>
<script>

	// The instanceReady event is fired, when an instance of CKEditor has finished
	// its initialization.
	CKEDITOR.on( 'instanceReady', function( ev ) {
		// Show the editor name and description in the browser status bar.
		document.getElementById( 'eMessage' ).innerHTML = 'Instance <code>' + ev.editor.name + '<\/code> loaded.';

		// Show this sample buttons.
		document.getElementById( 'eButtons' ).style.display = 'block';
	});
	
	function InsertHTML() {
		// Get the editor instance that we want to interact with.
		var editor = CKEDITOR.instances.editor;
		var value = document.getElementById( 'htmlArea' ).value;

		// Check the active editing mode.
		if ( editor.mode == 'wysiwyg' )
		{
			// Insert HTML code.
			// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-insertHtml
			editor.insertHtml( value );
		}
		else
			alert( 'You must be in WYSIWYG mode!' );
	}

	function InsertText() {
		// Get the editor instance that we want to interact with.
		var editor = CKEDITOR.instances.editor;
		var value = document.getElementById( 'txtArea' ).value;

		// Check the active editing mode.
		if ( editor.mode == 'wysiwyg' )
		{
			// Insert as plain text.
			// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-insertText
			editor.insertText( value );
		}
		else
			alert( 'You must be in WYSIWYG mode!' );
	}

	function SetContents() {
		// Get the editor instance that we want to interact with.
		var editor = CKEDITOR.instances.editor;
		var value = document.getElementById( 'htmlArea' ).value;

		// Set editor contents (replace current contents).
		// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-setData
		editor.setData( value );
	}

	function SubmitContents() {
		// Get the editor instance that you want to interact with.
		var editor = CKEDITOR.instances.editor;

		// Get editor contents
		// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-getData
		//alert( editor.getData() );
		console.log(editor.getData());
		document.getElementsByClassName("journal")[0].operation.value='submit';
		document.getElementsByClassName("journal")[0].submit();
	}

	function SaveContents() {
		// Get the editor instance that you want to interact with.
		var editor = CKEDITOR.instances.editor;

		// Get editor contents
		// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-getData
		//alert( editor.getData() );
		console.log(editor.getData());
		document.getElementsByClassName("journal")[0].operation.value='save';
		document.getElementsByClassName("journal")[0].submit();
		
	}
	
	function ExecuteCommand( commandName ) {
		// Get the editor instance that we want to interact with.
		var editor = CKEDITOR.instances.editor;

		// Check the active editing mode.
		if ( editor.mode == 'wysiwyg' )
		{
			// Execute the command.
			// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-execCommand
			editor.execCommand( commandName );
		}
		else
			alert( 'You must be in WYSIWYG mode!' );
	}

	function CheckDirty() {
		// Get the editor instance that we want to interact with.
		var editor = CKEDITOR.instances.editor;
		// Checks whether the current editor contents present changes when compared
		// to the contents loaded into the editor at startup
		// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-checkDirty
		alert( editor.checkDirty() );
	}

	function ResetDirty() {
		// Get the editor instance that we want to interact with.
		var editor = CKEDITOR.instances.editor;
		// Resets the "dirty state" of the editor (see CheckDirty())
		// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-resetDirty
		editor.resetDirty();
		alert( 'The "IsDirty" status has been reset' );
	}

	function Focus() {
		CKEDITOR.instances.editor.focus();
	}

	function onFocus() {
		document.getElementById( 'eMessage' ).innerHTML = '<b>' + this.name + ' is focused </b>';
	}

	function onBlur() {
		document.getElementById( 'eMessage' ).innerHTML = this.name + ' lost focus';
	}
</script>

<?php 
if(isset($_POST["action"])){
	
	if($_POST["action"] == "create"){
?>
    <div class="container">
		<div style = "left:50%;position:absolute;width:">
			<div style = "right: 50%;position:relative;">
				<form action = 'getSubmitJournal.php' method = "POST" class = "journal">
					<input type='hidden' name = 'Jaction' value='create'>
					<div class="form-horizontal">
						<div class="form-group">
							<label for="journal_title" class="col-sm-2 control-label">Title</label>
							<div class="col-sm-9">
								<input type="text" name = "journal_title" class="form-control" id="journal_title" placeholder="Journal title">

							</div>
						</div>
					</div>
					<textarea class = "form-control" rows = "3" name = "editor" id = "editor"></textarea>
					
					<div style = "margin-top: 10px;">
						<label for="journal_tag">Please set Tags: </label>
						<input type = "text" name = "tag1" id = "tag1" placeholder = "tag1" style = "width:90px">
						<input type = "text" name = "tag2" id = "tag2" placeholder = "tag2" style = "width:90px">
						<input type = "text" name = "tag3" id = "tag3" placeholder = "tag3" style = "width:90px">
						<input type = "text" name = "tag4" id = "tag4" placeholder = "tag4" style = "width:90px">
						<input type = "text" name = "tag5" id = "tag5" placeholder = "tag5" style = "width:90px">
					</div>
					
					<button type = "button" class = "btn btn-success" onclick = "SubmitContents()">Submit</button>
					<button type = "button" class = "btn btn-primary" onclick = "SaveContents()">Save</button>
				</form>
			</div>
		</div>
	</div>
<?php
	}
	else if($_POST["action"] == "edit"){
		if(isset($_POST["Jid"])){
			$jid = $_POST["Jid"];
			echo $jid."asdasds";
			$query = "SELECT * FROM travelJournal WHERE id = '$jid' ";
			$result= mysql_query($query,$conn) or die(mysql_error());
			$record= mysql_fetch_assoc($result);
?>
	 <div class="container">
		<div style = "left:50%;position:absolute;width:">
			<div style = "right: 50%;position:relative;">
				<form action = 'getSubmitJournal.php' method = "POST" class = "journal">
					<input type='hidden' name = 'Jaction' value='edit'>
					<input type='hidden' name = 'operation' value> 
					<input type='hidden' name = 'Jid' value= "<?php echo $_POST["Jid"]; ?>">
					<div class="form-horizontal">
						<div class="form-group">
							<label for="journal_title" class="col-sm-2 control-label"></label>
							<div class="col-sm-9">
								<input type="text" name = "journal_title" class="form-control" id="journal_title" value="<?php echo $record["journal_title"]; ?>">
							</div>
						</div>
					</div>
					<textarea class = "form-control" rows = "3" name = "editor" id = "editor" value="<?php echo $record["journal_content"]; ?>"></textarea>
					
					<div style = "margin-top: 10px;">
						<label for="journal_tag">Please set Tags: </label>
						<input type = "text" name = "tag1" id = "tag1" value="<?php echo $record["journal_tag1"]; ?>" style = "width:90px">
						<input type = "text" name = "tag2" id = "tag2" value="<?php echo $record["journal_tag2"]; ?>" style = "width:90px">
						<input type = "text" name = "tag3" id = "tag3" value="<?php echo $record["journal_tag3"]; ?>" style = "width:90px">
						<input type = "text" name = "tag4" id = "tag4" value="<?php echo $record["journal_tag4"]; ?>" style = "width:90px">
						<input type = "text" name = "tag5" id = "tag5" value="<?php echo $record["journal_tag5"]; ?>" style = "width:90px">
					</div>
					
					<button type = "button" class = "btn btn-success" onclick = "SubmitContents()">Submit</button>
					<button type = "button" class = "btn btn-primary" onclick = "SubmitContents()">Save</button>
				</form>
			</div>
		</div>
	</div>
<?php	
		}	
	}
}
?>
	<script>
			// Replace the <textarea id="editor1"> with an CKEditor instance.
		CKEDITOR.replace( 'editor', {
			on: {
				focus: onFocus,
				blur: onBlur,

				// Check for availability of corresponding plugins.
				pluginsLoaded: function( evt ) {
					var doc = CKEDITOR.document, ed = evt.editor;
					if ( !ed.getCommand( 'bold' ) )
						doc.getById( 'exec-bold' ).hide();
					if ( !ed.getCommand( 'link' ) )
						doc.getById( 'exec-link' ).hide();
				}
			}
		});
	</script>
	
<?php include '../templates/footer.html'; ?>