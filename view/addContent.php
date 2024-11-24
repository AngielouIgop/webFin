<html>

<head>
    <title>Add Content</title>
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
            border-radius: 5px;
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

        input[type="submit"],
        input[type="reset"] {
            padding: 10px 20px;
            background-color: pink;
            /* Button color */
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 5px;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: rgba(255, 192, 203, 0.8);
            /* Darker shade on hover */
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

<body class = "body">

    <form action='index.php?command=insertContent' method='post' enctype='multipart/form-data'>
        <table align="center" border="1">
            <tr>
                <td>ID:</td>
                <td><input type='text' name='ID'></input></td>
            </tr>
            <tr>
                <td>Title:</td>
                <td><input type='text' name='Title'></input></td>
            </tr>
            <tr>
                <td>Summary:</td>
                <td><input type='text' name='Summary'></input></td>
            </tr>
            <tr>
                <td colspan="2" align="center">Please upload book cover page</td>
            </tr>
            <tr>
                <td colspan="2" align="center"><img src="images/prev.png" id="previewImage" alt="preview" width="300"
                        height="300"></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <label for="fileToUpload" class="custom-file-button">Upload Cover Page</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" onchange="imagePreview(event)"
                        accept="image/*">
                </td>
            </tr>
            <tr>
                <td colspan="2">Description:</td>
            </tr>
            <tr>
                <td colspan="2"><textarea name='Description' cols=100 rows=10></textarea> </td>
            </tr>
            <tr>
                <td>Content Type:</td>
                <td><input type='text' name='ContentType'></input></td>
            </tr>
            <td colspan='6' align='center'>
                <input type='submit' value='Save Records' name='saveRecords'>
                <input type='reset' value='Reset'>
            </td>
        </table>
    </form>
</body>

</html>