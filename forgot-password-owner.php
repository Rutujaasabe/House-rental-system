<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
    include 'connect.php';
    global $conn;
    if (isset($_POST['login'])) {
        $name = $_POST['email'];
        $passward = $_POST['passward'];
        $select_query = "select * from owner where email = '$name' and passward = '$passward'";
        $data = mysqli_query($conn, $select_query);
        if (mysqli_num_rows($data) == 1) {
            while ($row = mysqli_fetch_assoc($data)) {
                if (mysqli_num_rows($data) == 1 &&  ''.$row['status'].'' == 'Active' && ''.$row['U_role'].'' == 'Super Admin' ) {
                    header("Location:./owner-register.php");
                }
                
                else if(mysqli_num_rows($data) == 1 &&  ''.$row['status'].'' == 'In-active'){
                    function alert(){
                        echo '
                        <script type="text/javascript">
                            $(document).ready(function (e) {
                                swal("Your Registration Is Not Confirmed", "Please contact admin to confirm your registration!", "warning");
                            });
                        </script>';
                    }
                    alert();
                }
                
            }
        }
        else{
            function alert1(){
                echo '
                <script type="text/javascript">
                    $(document).ready(function (e) {
                        swal("Wrong email or Passward", "Please chech email and passward!", "error");
                    });
                </script>';
            }
            alert1();
        }
        
        session_start();
        $select_id_query = "select owner_id from owner where email = '$name' and passward = '$passward'"; 
        $data_user_id = mysqli_query($conn, $select_id_query);
        if (mysqli_num_rows($data_user_id) > 0) {
           while ($row = mysqli_fetch_assoc($data_user_id)) {
              $user_id = $row['owner_id'];
              $_SESSION['owner_id'] = $user_id;
           }
        }
    }

    if (isset($_POST['register'])) {
        $name = $_POST['Full Name'];
        $email = $_POST['Email'];
        $passward = $_POST['passward'];
        $confirm_passward = $_POST['Confirm Passward'];
        $contact = $_POST['Phone No'];
        $role =$_POST['Address'];
        if ($passward == $confirm_passward) {
            $insert_query  = "insert into owner(Full Name,Passward,Email,Contact No,Address,status) Values ('$name','$passward','$email','$contact','$role','In-active')";
            $data = mysqli_query($conn,$insert_query);
            if ($data) {
                function alert(){
                    echo '
                    <script type="text/javascript">
                        $(document).ready(function (e) {
                            swal("User Registered Successfully", "Please wait until you active", "success");
                        });
                    </script>';
                }
                alert();
            }
        }
        else{
            function alert(){
                echo '
                <script type="text/javascript">
                    $(document).ready(function (e) {
                        swal("Passward Not Match", "Please check passward and confirm passward!", "error");
                    });
                </script>';
            }
            alert();
        }

    }
?>