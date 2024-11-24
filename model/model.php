<?php
class Model
{
    public $db = null;
    function __construct() //constructor function that establishes connection with database
    {
        try {
            $this->db = new mysqli('localhost', 'root', '', 'content');
        } catch (exception $e) {
            exit('Database connection could not be established.');
        }
    }
    //function to fetch content from database
    public function getContent()
    {
        $data = array(); //array to store data
        $queryGetContent = mysqli_query($this->db, "SELECT * FROM content"); 

        while ($getRow = mysqli_fetch_object($queryGetContent)) {
            $data[] = $getRow; 
        }

        return $data;
    }

    // Fetch content based on ID
    public function getContentDet($id)//function that fetches content based on ID
    {
        $data = array(); // array where the data is stored

        $stmt = $this->db->prepare("SELECT * FROM content WHERE ID = ?");
        $stmt->bind_param("s", $id); //bind parameters for safer query and to make sure it is binded to $id
        $stmt->execute();
        $result = $stmt->get_result();

        if ($getRow = $result->fetch_object())  //fetch the data and store it in $getRow
        {
            $data = $getRow;
        }

        $stmt->close();
        return $data;
    }

    public function getImagePathById($id)
    {
        // Prepare the query to fetch the image path for the given record ID
        $stmt = $this->db->prepare("SELECT images FROM content WHERE id = ?");
        
        // Bind the ID parameter (assuming the ID is an integer)
        $stmt->bind_param("i", $id); 
    
        // Execute the statement
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();
    
        // Check if a result was returned
        if ($result && $result->num_rows > 0) {
            // Fetch the row and return the image path
            $row = $result->fetch_assoc();
            return $row['images'];
        }
    
        // Return null if no record was found
        return null;
    }
    

    public function deleteRecord($id)//function to delete a record based on ID
    {
        $deleteQuery = "DELETE from content where id=$id";

        $result = mysqli_query($this->db, $deleteQuery); //deletes record when id is found

        if (!$result)
            return mysqli_error($this->db); //if result is false return error
        else
            return "Record Deleted";
    }

    public function checkImageUpload($imageSize, $imageFileType, $target_file) //function that validates beforeuploading an image 
    {

        $uploadOk = 1; //variable to that is sent back when the image is successfully uploaded
        $errMsg = "1"; //variable that is sent back when image is unsuccessfully uploaded



        if ($imageSize !== false) {
            // Check if file already exists
            $uploadOk = 1;
            if (file_exists($target_file)) {
                $errMsg = "Sorry, file already exists.";
                $uploadOk = 0;
            } else {
                // Check file size

                if ($_FILES["fileToUpload"]["size"] > 5000000) {
                    var_dump($imageSize);
                    $errMsg = "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // check certain file formats
                else if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {
                    $errMsg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

            }
        } else {
            $errMsg = "File is not an image.";
            $uploadOk = 0;
        }


        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $errMsg = $errMsg;

        } else // if everything is ok, try to upload file
        {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $errMsg = "OK";

            } else {
                $errMsg = "Sorry, there was an error uploading your file.";
            }
        }
        return $errMsg;
    }
    //------------------------------------------------------------------------------------------------
    public function insertContent($id, $title, $summary, $description, $contenttype, $images) {
        $stmt = $this->db->prepare("INSERT INTO content(ID, Title, Summary, Descriptions, Contenttype, images) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $id, $title, $summary, $description, $contenttype, $images);
        if ($stmt->execute()) {
            return "Record Save";
        } else {
            return $stmt->error;
        }
    }

     public function searchContent($id)
        {
        	$data = array(); //arr

    		$queryGetID = mysqli_query($this->db,"SELECT * from content where id='".$id."'");

    		while($getRow=mysqli_fetch_object($queryGetID))
    		{
    		  $data[] = $getRow; // add the row in to the results (data) array
    		}
    		return $data; //returns the data from the database
        }

    public function updateRecords($id, $title, $summary, $description, $contenttype, $images = null) {
        $updateQuery = "UPDATE content SET Title='$title', Summary='$summary', Descriptions='$description', Contenttype='$contenttype'";

        if ($images !== null) {
            $updateQuery .= ", Images='$images'";
        }

        $updateQuery .= " WHERE id='$id'";
        $result = mysqli_query($this->db, $updateQuery);

        return $result ? "Record Updated" : mysqli_error($this->db);
    }

    public function findContent($keyword)
     {
        $data = array();
    
        $stmt = $this->db->prepare("SELECT * FROM content WHERE Title LIKE ? OR ContentType LIKE ?");
        $searchParam = '%' . $keyword . '%';
        $stmt->bind_param("ss", $searchParam, $searchParam);
        $stmt->execute();
        $result = $stmt->get_result();
    
        while ($row = $result->fetch_object()) {
            $data[] = $row;
        }
    
        $stmt->close();
        return $data;
    }


}

