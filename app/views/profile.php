<?php require_once "../../config.php";?>
<?php require_once "../partials/header.php";?>
<?php require_once "../controllers/connect.php";?>
<?php require_once "../controllers/functions.php";?>

<?php 
    $id = $_GET['id'];
    if(empty($id)) {
        header("location: index.php");
    } else {

        $sql = "SELECT * FROM tbl_users WHERE id = $id";

        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);

        $id = $row['id'];      
        $fname = ucfirst($row['first_name']);   
        $lname = ucfirst($row['last_name']);  
        $username = $row['username'];      
        $email = $row['email'];
        $profile_pic = $row['profile_pic'];

        if($profile_pic == "") {
            $profile_pic = DEFAULT_PROFILE; 
        } else {
            $profile_pic = BASE_URL . $profile_pic . "_80x80.jpg";
        } 
    }          
?>
    <!-- PAGE CONTENT -->
    <div class="container mt-5">
        <div class="row pt-5">
            <!-- SIDE BAR -->
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-4">
                        <img src='<?= $profile_pic ?>'  class="user-photo circle" height="80">
                    </div>
                    <div class="col">
                        <div class="font-weight-bold mt-4"> <?= $username ?> </div>
                        <a class='nav-link modal-link px-0' href='#' data-id='<?= $id ?>' data-url='../partials/templates/edit_user_modal.php' role='button'>
                            <i class="far fa-edit"></i>
                            Edit Profile
                        </a>
                    </div>
                </div>
                <hr>
            </div>
            <!-- /SIDE BAR -->
            <!-- MAIN BAR-->
            <div class="col border border-secondary">
                <div class="row pt-5 pl-5 flex-column">
                    <h4>My Profile</h4>
                    <div>Manage and protect your account</div>
                </div>

                <hr class="mb-5">
                
                <div class="row">
                    <!-- LEFT OF MAIN BAR -->
                    <div class="col-lg-8 border-right pl-5">

                        <div class="row mb-5">
                            <div class="col-lg-3">
                                Name
                            </div>
                            <div class="col">
                                <?= $fname . " " . $lname ?>
                            </div>
                        </div>  

                        <div class="row mb-5">
                            <div class="col-lg-3">
                                Email
                            </div>
                            <div class="col">
                                <?= hide_email($email) ?>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-lg-3">
                                Phone Number
                            </div>
                            <div class="col">
                                <a href="#">Add</a>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-lg-3">
                                Home Address
                            </div>
                            <div class="col">
                                <a href="#">Add</a>
                            </div>
                        </div>


                        <div class="row mb-5">
                            <div class="col-lg-3">
                                Office Address
                            </div>
                            <div class="col">
                                <a href="#">Add</a>
                            </div>
                        </div>


                    </div>
                    <!-- /LEFT OF MAIN BAR -->

                    <!-- RIGHT OF MAIN BAR -->
                    <div class="col">
                        <div class="row justify-content-center mb-5">
                            <img src='<?= $profile_pic ?>'  class="user-photo circle" height="80">
                        </div>
                        <div class="row justify-content-center">
                            <a class='nav-link modal-link btn border mb-5' href='#' data-id='<?= $id ?>' data-url='../partials/templates/upload_modal.php' role='button'>
                                <i class="fas fa-camera"></i>
                                Update Image
                            </a>
                        </div>

                        <div class="row text-center justify-content-center flex-column mb-5">
                            <div>File size: Max of 1MB</div>
                            <div>File extension: .JPG, .JPEG, .PNG</div>
                        </div>
                    </div>
                    <!-- /RIGHT OF MAIN BAR -->
                </div>
            </div>
            <!-- /MAIN BAR -->


        </div>
        <!-- /.ROW -->
    </div>
    <!-- /.CONTAINER -->


<!-- FOOTER -->
<?php require_once "../partials/footer.php";?>

<!-- MODAL -->
<?php require_once "../partials/modal_container.php";?>

  