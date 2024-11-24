<html>

<head>
	<title>Edit Content</title>

	<link rel="stylesheet" href="css/contentBg.css">
	<script type="text/javascript">
		function imagePreview(event) {

			if (event.target.files.length > 0) {
				var src = URL.createObjectURL(event.target.files[0]);
				var preview = document.getElementById("previewImage");
				preview.src = src;
				preview.style.display = "block";
			}
		}

	</script>
	<style type="text/css">
		input[type="file"] {
			display: none;
		}

		body {
			max-width: 800px;
			/* Limit body width */
			margin: 0 auto;
			/* Center body on the page */
			padding: 20px;
			/* Add padding around the form */
			background-color: #f4f4f4;
			/* Light background color */
			font-family: Arial, sans-serif;
			/* Improve font style */
			padding-top: 86px;
		}

		table {
			width: 100%;
			/* Make table take full width within the body */
			background-color: #fff;
			border-collapse: collapse;
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
			/* Add shadow for depth */
		}

		td {
			padding: 10px;
			font-size: 14px;
		}

		input[type="text"],
		textarea {
			width: 100%;
			/* Expand text inputs to full width */
			padding: 8px;
			border: 1px solid #ccc;
			border-radius: 4px;
		}


		.custom-file-button {
			border: 1px solid #ccc;
			display: inline-block;
			padding: 6px 12px;
			cursor: pointer;
			background-color: pink;
			color: #fff;
			padding: 10px 20px;
		}
	</style>

</head>

<body class="body">

	<!-- <form action='index.php?command=13' method='post'> -->
	<form action='index.php?command=updateRec' method='post' enctype='multipart/form-data'>
		<table align="center" border="1">
			<tr>
				<td>ID:</td>
				<td><input type='text' name='ID' value='<?php echo $content[0]->ID ?>'></input></td>
			</tr>
			<tr>
				<td>Title:</td>
				<td><input type='text' name='Title' value='<?php echo $content[0]->Title ?>'></input></td>
			</tr>
			<tr>
				<td colspan="2" align="center">Please upload book cover page</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<img src="<?php echo (!empty($content) && !empty($content[0]->images)) ? $content[0]->images : 'images/default-image.png'; ?>"
						id="previewImage"
						alt="<?php echo (!empty($content) && !empty($content[0]->Title)) ? htmlspecialchars($content[0]->Title) : 'Default Preview'; ?>"
						width="300" height="300">
				</td>
			</tr>

			<tr>
				<td colspan="2" align="center">
					<label for="fileToUpload" class="custom-file-button">Upload Cover Page</label>
					<input type="file" name="fileToUpload" id="fileToUpload" onchange="imagePreview(event)"
						accept="image/*">
				</td>
			</tr>
			<tr>
				<td colspan="2">Summary</td>
			</tr>
			<tr>
				<td colspan="2"><textarea name='Summary' cols=35 rows=10><?php echo $content[0]->Summary ?></textarea>
				</td>
			</tr>
			<tr>
				<td>Description:</td>
				<td><input type='text' name='Description' value='<?php echo $content[0]->Descriptions ?>'></input></td>
			</tr>
			<tr>
				<td>ContentType:</td>
				<td><input type='text' name='ContentType' value='<?php echo $content[0]->ContentType ?>'></input></td>
			</tr>
			<td colspan='6' align='center'>
				<input type='submit' value='Update Records' name='saveRecords'>
				<input type='reset' value='Reset'>
			</td>
		</table>
	</form>
</body>

</html>