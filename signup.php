



 <?php 
        if(isset($_POST["sub"]))
        {
            //check password and confirm
            if($_POST["pw"] == $_POST["con"])
            {
                $con=new mysqli("localhost","root","","orders");
                //check email existence
                $st = $con->prepare("select * from users where email=?");
                $st->bind_param("s", $_POST["em"]);
                $st->execute();
                $rs = $st->get_result();
                //E-Mail validation
                if($rs->num_rows > 0)
                    echo '<script>alert("E-Mail already exist");</script>';
                else{
                    //Signup process
                $st = $con->prepare("insert into users values(?,?,?,?)");
                $st->bind_param("ssss", $_POST["em"],$_POST["pw"],
                        $_POST["nm"],$_POST["ph"]);
                $st->execute();
                $_SESSION["user"] = $_POST["em"];
                echo '<script>window.location="index.php";</script>';
                }
            }
            else
                echo '<script>alert("Password Not Match");</script>';
           
        }
 ?>

