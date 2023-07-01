<?php
include 'session.php';
include 'database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Team</title>
    <script src="https://kit.fontawesome.com/28e3060a5c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="hr.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <p class="navbar-brand d-inline mb-0 h1">Welcome <?php echo $login_session; ?></p>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a href="logout.php"><i class="fa-solid fa-right-from-bracket text-light mx-5"></i></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="get">
                <input type="text" name="search" required value="<?php if (isset($_GET['search'])) {
                                                                        echo $_GET['search'];
                                                                    } ?>" class="form-control" placeholder="Search data">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="tab">
        <button class="btn btn-warning my-3" id="showall">Show All</button>
        <div id="table2">
            <table class="table border table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">AppNo</th>
                        <th scope="col" class="text-center">First Name</th>
                        <th scope="col" class="text-center">Last Name</th>
                        <th scope="col" class="text-center">Middle Initial</th>
                        <th scope="col" class="text-center">Email</th>
                        <th scope="col" class="text-center">Phone Number</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['search'])) {
                        $filtervalues = $_GET['search'];
                        $query = "SELECT * FROM app WHERE CONCAT_WS(' ',FirstName,LastName) LIKE '%$filtervalues%' ";
                        $query_run = mysqli_query($conn, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $items) {
                    ?>
                                <tr>
                                    <td class="text-center"><?= $items['ApplicationNo']; ?></td>
                                    <td class="text-center"><?= $items['FirstName']; ?></td>
                                    <td class="text-center"><?= $items['LastName']; ?></td>
                                    <td class="text-center"><?= $items['MI']; ?></td>
                                    <td class="text-center"><?= $items['Email']; ?></td>
                                    <td class="text-center"><?= $items['PhoneNumber']; ?></td>
                                    <td class="text-center">
                                        <a class="text-light" href="update.php?updateid=<?= $items['ApplicationNo']; ?>"><button class="btn btn-success">Update</button></a>
                                        <a class="text-light" href="delete.php?deleteAppno=<?= $items['ApplicationNo']; ?>"><button class="btn btn-danger">Delete</button></a>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="4">No Record Found</td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- table for all data -->
        <div id="table1" style="display:none">
            <table class="table border table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">AppNo</th>
                        <th scope="col" class="text-center">First Name</th>
                        <th scope="col" class="text-center">Last Name</th>
                        <th scope="col" class="text-center">Middle Initial</th>
                        <th scope="col" class="text-center">Email</th>
                        <th scope="col" class="text-center">Phone Number</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT ApplicationNo, FirstName, LastName, MI,Email, PhoneNumber FROM app";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $Appno = $row['ApplicationNo'];
                            $fn = $row['FirstName'];
                            $ln = $row['LastName'];
                            $mi = $row['MI'];
                            $mail = $row['Email'];
                            $pn = $row['PhoneNumber'];
                            echo '<tr>
                <th scope="row" class="text-center">' . $Appno . '</th>
                <td class="text-center">' . $fn . '</td>
                <td class="text-center">' . $ln . '</td>
                <td class="text-center">' . $mi . '</td>
                <td class="text-center">' . $mail . '</td>
                <td class="text-center">' . $pn . '</td>
                <td class="text-center">
                <a class="text-light" href="update.php?updateid=' . $Appno . '"><button class="btn btn-success">Update</button></a>
                <a class="text-light" href="delete.php?deleteAppno=' . $Appno . '"><button class="btn btn-danger">Delete</button></a>
                </td>
              </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const btn = document.getElementById('showall');


        btn.addEventListener('click', () => {
            const tab2 = document.getElementById('table2');
            const tab1 = document.getElementById('table1');

            tab2.style.display = 'none';
            tab1.style.display = 'block';
        });
    </script>


</body>

</html>