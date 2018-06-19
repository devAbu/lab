<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<title>LAB EXAM</title>
</head>

<body>
<form method="POST" action="labexam.php">
<table align="center" >
<tr><th colspan="2" align="center"  style="background-color:blue"> Student's Registration Form</th></tr>


<tr bgcolor="blue"><td align="right">Student's name</td>
<td><input type=text name="student_name"></td>
<td><font color="red"> <?php echo@$_GET["greska1"]; ?></font></td>
</tr>


<tr>
<td align="right">Father's name</td>
<td>
<input type=text name="father_name">
</td>
<td><font color="red"> <?php echo@$_GET["greska2"]; ?></font></td>
</tr>

<tr bgcolor="blue">
<td align="right">School's name</td>
<td>
<input type=text name="school_name">
</td>
<td><font color="red"> <?php echo@$_GET["greska3"]; ?></font></td>
</tr>

<tr bgcolor="blue">
<td align="right">Roll No</td>
<td>
<input type=text name="roll_no" id="ppp" >

</td>
<td><font color="red"> <?php echo@$_GET["greska4"]; ?></font></td>
</tr>

<tr bgcolor="blue">
<td align="right">Class</td>
<td>
<select name="select">
<option value=-1>Select</option>
<option value=10>10th</option>
<option value=9th>9th</option>
</select></td>
<td><font color="red"> <?php echo @$_GET["greska5"]; ?></font></td>
</tr>   

<tr><td colspan="2" align="center"><button type="button" onclick="validation()">Submit</button</td></tr>
</table>
</form>


<script>function validation()
 {
    var combe;
    var tekst;
    combe = document.getElementById("roll_no").value;
    if (isNaN(combe))
        text = "Input not valid"; 
     else
        text = "Input OK";
    document.getElementById("ppp").innerHTML = text;
}</script>

<?php 

    $connection= mysqli_connect("localhost", "root", "");

    if(!$connection)
    {
        die("Error" .myspli.error());
    }

    $select= mysqli_select_db($connection, "school");

    if(!$select)
    {
        die("Error" .mysqli.error());
    }

    if(isset($_POST['submit'])){
    
        {
            $prva= $_POST["student_name"];
            $druga= $_POST["father_name"];
            $treca= $_POST["school_name"];
            $cetvrta= $_POST["roll_no"];
            $peta= $_POST["select"];
    
            if($prva == "" || $prva>70){
            echo "<script> window.open('labexam.php?greska1=error' ,'_self'</script>";
                }   
            if($druga=="" || $druga>70)
            echo "<script> window.open ('labexam.php?greska2=error', '_self'</script>";
    
            if($treca=="" || $treca>70)
            echo "<script> window.open ('labexam.php?greska3=error', '_self'</script>";
    
            if($cetvrta=="")
            echo "<script> window.open ('labexam.php?greska4=error', '_self'</script>";
    
            if($peta=="")
            echo "<script> window.open ('labexam.php?greska5=error', '_self'</script>";
    
            else 
            $query= "INSERT INTO student(student_name, father_name, student_school, student_roll, class) VALUES ('$prva', '$druga', '$treca', '$cetvrta', '$peta')";
    
            $result=mysqli_query($connection, $query);
    
                
            echo "<table> 
            <tr>
            <th>Name</th>
            <th>Father name</th>
            <th>School</th>
            <th>Roll no</th>
            <th>Class</th>
            </tr>
            <tr>
            <td>$prva</td>
            <td>$druga</td>
            <td>$treca</td>
            <td>$cetvrta</td>
            <td>$peta</td>
            </tr>
            </table>";
        

            if(!$result)
            {
                echo "ERROR";
            }
    }

    $view= "SELECT * from students";
    
        $result1=mysqli_query($connection, $view);
    
        if($result1-> num_rows >0 )
        {
            while($row= $result-> fetch_assoc())
            {
                echo "Student name:".$row['student_name']. ;  
                echo "father name:".$row['father_name']. ;
                echo "School:".$row['school_name']. ;
                echo "Roll no:".$row['roll_no']. ;
                echo "Class name:".$row['class']. ;
            }
        }

    if(isset($_POST['search']))
    {
        $keywords = $_POST['search_stu'];
        $search = "SELECT * FROM students WHERE $prva like '%$keywords' OR $cetvrta like '%$keywords'";
        $search_run = mysql_query($connection, $search);
        $count = mysql_num_rows($search_run);
    
    if($keywords == "")
    {
    echo"<script>document.getElementById('result').innerHTML='Please enter any keyword'</script>";
    exit();
    }
    if($count == 0)
    {
        echo "<script>document.getElementById('result').innerHTML='No Record Found, Please Try again...'</script>";
        exit();
    }
    while($row_search=mysql_fetch_array($search_run)){
    $sname = $row_search['student_name'];
    $sschool = $row_search['school_name'];
    $sroll = $row_search['roll_no'];
    $sclass = $row_search['class'];


    
    mysqli_close($connection);
?>


</body>

</html>