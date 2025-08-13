<?php
require "DBCon.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['actid'], $_POST['acttitle'], $_POST['actdes'])) {
        $actid1 = $_POST['actid'];
        $acttitle1 = $_POST['acttitle'];
        $actdesc1 = $_POST['actdes'];
        $stmt = $con->prepare("INSERT INTO `ActivityList` (ActID, ActTitle, ActDesc) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $actid1, $acttitle1, $actdesc1);

        if ($stmt->execute()) {
            echo "<script>alert('Added Successfully');</script>";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "<script>alert('Adding Unsuccessful');</script>";
        }
        $stmt->close();
    }
}
?>
<!-- Edit Activity PHP -->
<?php
require "DBCon.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['actidedit'], $_POST['acttitleedit'], $_POST['actdesedit'])) {
        $editedid = $_POST['actidedit'];
        $editedtitle = $_POST['acttitleedit'];
        $editedsesc = $_POST['actdesedit'];
        $stmt = $con->prepare("UPDATE `ActivityList` SET ActTitle = ?, ActDesc = ? WHERE ActID = ?");
        $stmt->bind_param("ssi", $editedtitle, $editedsesc, $editedid);

        if ($stmt->execute()) {
            echo "<script>alert('Edited Successfully');</script>";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "<script>alert('Editing Unsuccessful');</script>";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <h1 style="text-align:center;">My Daily Life Activity</h1>
    <table class="table" style="text-align:center;">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Sl.No.</th>
                <th scope="col">Activity</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
                <th>
                    <form class="form-inline my-2 my-lg-0" method="post" action="index.php">
                        <input name="src1" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </th>
            </tr>
        </thead>
        <tbody>
            <!-- PHP to highlight words in search if searched -->
            <?php
            require "DBCon.php";
            if (isset($_POST['src1'])) {
                $srch = "%" . $_POST['src1'] . "%";
                $stmt = $con->prepare("SELECT * FROM `ActivityList` WHERE ActTitle LIKE ? OR ActDesc LIKE ?");
                $stmt->bind_param("ss", $srch, $srch);
                $stmt->execute();
                $exc = $stmt->get_result();

                // Highlight words in text
                function highlightWords($text, $word)
                {
                    $text1 = preg_replace('#' . preg_quote($word) . '#i', '<mark class="text-black bg-warning">\\0</mark>', $text);
                    return $text1;
                }
                $cnt = 1;
                if (mysqli_num_rows($exc) > 0) {
                    while ($row = mysqli_fetch_assoc($exc)) {
                        // Highlight words in text
                        $highTitle = !empty($srch) ? highlightWords($row['ActTitle'], $srch) : $row['ActTitle'];
                        $highDesc = !empty($srch) ? highlightWords($row['ActDesc'], $srch) : $row['ActDesc'];
                        echo '
    <tr>
      <th scope="row">' . $cnt . '</th>
      <td >' . $highTitle . '</td>
      <td >' . $highDesc . '</td>
      <td >
      <a href="index.php?acID=' . $row["ActID"] . '" data-toggle="modal" data-target="#exampleModal1" class="btn btn-outline-primary btn-md"">Edit</button>
      <a class="btn btn-outline-danger" href="index.php?acID=' . $row["ActID"] . '">Delete</a>
      </td>
    </tr>';
                        $cnt++;
                    }
                }
            } else {
                $q1 = "SELECT * FROM `Activitylist`";
                $ex1 = mysqli_query($con, $q1);
                $cnt = 1;
                if (mysqli_num_rows($ex1) > 0) {
                    while ($rows = mysqli_fetch_assoc($ex1)) {
                        echo '
    <tr>
      <th scope="row">' . $cnt . '</th>
      <td >' . $rows['ActTitle'] . '</td>
      <td >' . $rows['ActDesc'] . '</td>
      <td >
      <button type="button" data-toggle="modal" data-target="#exampleModal1" class="btn btn-outline-primary btn-md"">Edit</button>
      <a class="btn btn-outline-danger" href="index.php?acID=' . $rows["ActID"] . '">Delete</a>
      </td>
    </tr>';
                        $cnt++;
                    }
                }
            }
            echo '</tbody></table>';


            // Delete php
            if (isset($_GET['acID'])) {
                $dtID = $_GET['acID'];
                $stmt = $con->prepare("DELETE FROM `ActivityList` WHERE ActID = ?");
                $stmt->bind_param("i", $dtID);
                if ($stmt->execute()) {
                    $stmt2 = $con->prepare("UPDATE `ActivityList` SET ActID = ActID - 1 WHERE ActID > ?");
                    $stmt2->bind_param("i", $dtID);
                    if ($stmt2->execute()) {
                        echo "<script>alert('Deleted Successfully'); window.location.href='index.php';</script>";
                    } else {
                        echo "<script>alert('Deleted Unsuccessful'); window.location.href='index.php';</script>";
                    }
                    $stmt2->close();
                }
                $stmt->close();
            }
            ?>
            <!-- Add Activity Modal -->
            <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#exampleModalCenter">Add your Activity</button>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Activity</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="#">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Activity ID</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter id" name="actid">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Activity Title</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Title" name="acttitle">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Enter Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="actdes"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit modal -->
            <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Activity</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="#">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Activity ID</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Title" name="actidedit">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Activity Title</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Title" name="acttitleedit">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Enter Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="actdesedit"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- JavaScript -->
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>