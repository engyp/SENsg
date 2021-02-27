<?php
//default navigation
$navi = "<nav>
    <a href='login.php'>Login</a>|
    <a href='register.php'>Register</a>
    </nav>";
	
// STUDENT navigation
//add additional navigation based on your roles here
$studentNavi = "<nav>
    <a href='viewData.php'>View Student Data</a>
    <a href='searchData.php'>Search Data</a>
    <a href='chatIndex.php'>Chat</a>
    <a href='logout.php'>Log Out</a>
    </nav>";
	
// TEACHER navigation
//add additional navigation based on your roles here
$teacherNavi = "<nav>
    <a href='heatMapTemp.php'>Heat Map</a>
    <a href='mapMarker.php'>Marker Map</a>
    <a href='viewStudentInfo.php'>View Student Info</a>
    <a href='viewAllStudentData.php'>View All Student Data</a>
    <a href='logout.php'>Log Out</a>
    </nav>";
	
// RESEARCHER navigation
//add additional navigation based on your roles here
$researcherNavi = "<nav>
    <a href='researcherHome.php'>Home</a>
    <a href='viewAnonData.php'>View Data</a>
    <a href='downloadAnonData.php'>Download Data</a>
    <a href='viewAnonMap.php'>View Map</a>
    <a href='viewSensorList.php'>View Sensor List</a>
    <a href='addSensor.php'>Add Sensor</a>
    <a href='viewResearcherProfile.php'>View Profile</a>
    <a href='logout.php'>Logout</a> 
    </nav>";
	
// ADMIN navigation
//add additional navigation based on your roles here
$adminNavi = "<nav>
    <a href='viewAllUser.php'>Home</a>
    <a href='logout.php'>Log Out</a>
    </nav>";


if (isset($_SESSION['user'])) {
    if ($_SESSION['role'] == "Admin") {
        echo $adminNavi;
    } elseif ($_SESSION['role'] == "Student") {
        echo $studentNavi;
    } elseif ($_SESSION['role'] == "Teacher") {
        echo $teacherNavi;
    } else {
        echo $researcherNavi;
    }
} else {
    echo $navi;
}