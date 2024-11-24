<?php
class Controller
{
    public $model = null;

    function __construct()
    {
        require_once('model/model.php'); //initialize the model class
        $this->model = new Model(); //calling the model using constructor
    }

    public function getWeb()
    {
        $command = 'home'; //default command when no command is specified
        if (isset($_REQUEST['command'])) {
            $command = $_REQUEST['command'];
        }

        switch ($command) {
            case 'home':
                include('html/HomePage.html');
                break;

            case 'about':
                include('html/About Us.html');
                break;

            case 'viewContent':
                $content = $this->model->getContent(); 
                include('view/viewcontent.php');
                break;

            case 'searchContent': {
                    $keyword = $_REQUEST['keyword'] ?? '';
                    $content = $this->model->findContent($keyword);
                    include('view/viewcontent.php');
                    break;
                }

            case 'viewcontentdet':
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $contentDetails = $this->model->getContentDet($id);
                    include('view/viewcontentdet.php');
                } else {
                    echo "No ID provided.";
                }
                break;

                case 'deleteRec': {
                    $id = $_REQUEST['ID'];
                    
                    // Step 1: Fetch the image path from the database
                    $imagePath = $this->model->getImagePathById($id);
                    
                    // Step 2: Check if the image file exists and delete it
                    if ($imagePath && file_exists($imagePath)) {
                        if (unlink($imagePath)) { // deletes file using unlink method
                            // Optional: Log or notify the success of file deletion
                        } else {
                            echo "<script>alert('Failed to delete the image file.');</script>";
                        }
                    }
                
                    // Step 3: Delete the record from the database
                    $result = $this->model->deleteRecord($id);
                
                    // Step 4: Redirect or display a success message
                    echo "<script> 
                            alert('" . $result . "'); 
                            window.location.href='index.php?command=viewContent'; 
                          </script>";
                    break;
                }
                

            case 'addBooks': {
                include('view/addContent.php');
                break;
            }
            //add content
            case 'insertContent': {
                // Fetch form data
                $id = $_REQUEST['ID'];
                $title = $_REQUEST['Title'];
                $summary = $_REQUEST['Summary'];
                $description = $_REQUEST['Description'];
                $contenttype = $_REQUEST['ContentType'];

                // Handle file upload
                $imageUpload = basename($_FILES["fileToUpload"]["name"]);
                $imagePath = "uploads/" . $imageUpload;
                $imageFileType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));

                // Check if the uploaded file is a valid image
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                $err = $this->model->checkImageUpload($check, $imageFileType, $imagePath);

                if ($err == "OK") {
                    // If image upload was successful, insert the content into the database
                    $result = $this->model->insertContent($id, $title, $summary, $description, $contenttype, $imagePath);
                    echo '<script> alert ("' . $result . '")</script>';
                    include 'view/addContent.php';
                } else {
                    // If there was an error with the image upload
                    echo '<script> alert ("' . $err . '")</script>';
                }
                break;
            }
            case 'editContent'://Edit content
            {

                $id = $_REQUEST['ID'];

                $content = $this->model->searchContent($id);

                include 'view/editContent.php';
                break;
            }

            case 'updateRec': {
                $id = $_REQUEST['ID'];
                $title = $_REQUEST['Title'];
                $summary = $_REQUEST['Summary'];
                $description = $_REQUEST['Description'];
                $contenttype = $_REQUEST['ContentType'];

                $imagePath = $this->model->getImagePathById($id);
                    
                // Step 1: Check if the image file exists and delete it
                if ($imagePath && file_exists($imagePath)) {
                    if (unlink($imagePath)) { // deletes file using unlink method
                        // Optional: Log or notify the success of file deletion
                    } else {
                        echo "<script>alert('Failed to delete the image file.');</script>";
                    }
                }

                $imagePath = null; // Default to null if no new image is uploaded

                if (!empty($_FILES["fileToUpload"]["name"])) { 
                    $imageUpload = basename($_FILES["fileToUpload"]["name"]);
                    $imagePath = "uploads/" . $imageUpload;
                    $imageFileType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

                    $err = $this->model->checkImageUpload($check, $imageFileType, $imagePath);

                    if ($err !== "OK") {
                        echo '<script> alert ("' . $err . '")</script>';
                        $imagePath = null; // Reset imagePath if there was an error
                    }
                }

                // Pass $imagePath, which may be null if no new image was uploaded
                $result = $this->model->updateRecords($id, $title, $summary, $description, $contenttype, $imagePath);
                echo "<script> alert ('" . $result . "'); window.location.href='index.php?command=viewContent'; </script>";
                break;
            }
            
            default:
                include('html/HomePage.html');
                break;
        }
    }
}
?>