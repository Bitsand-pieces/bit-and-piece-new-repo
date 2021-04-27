<?php
include('assets/dbConfig.php');
if ($_SESSION['is_logged_in'] == true) {
    include('assets/header.php');
    include('assets/navbar.php');
    require('functions.php');
    require('image_path.php');

    if (isset($_GET['type']) && $_GET['type'] != '') {
        $type = get_safe_value($conn, $_GET['type']);

        if ($type == 'delete') {
            $id = get_safe_value($conn, $_GET['id']);
            $delete_sql = "DELETE FROM posts WHERE id='$id'";
            mysqli_query($conn, $delete_sql);
        }
    }

    $sql = "SELECT * FROM posts WHERE id=id ORDER BY id desc";
    $res = mysqli_query($conn, $sql);

?>
<div class="row">


    <?php
        while ($row = mysqli_fetch_assoc($res)) {
        ?>
    <div class="column">
        <div class="card">
            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $row['image'] ?>" class="img-fluid"
                    style="height: 300px;object-fit: contain;" />

            </div>
            <div class="card-body">
                <h4 class="card-title"><?php echo $row['food_name'] ?></h4>

                <div class="card-text">
                    <?php echo $row['short_description'] ?>
                    <p><a href="post__details.php?id=<?php echo $row['id'] ?>">more details..</a></p>
                </div>
                <h4>Name : <?php echo $row['name'] ?></h4>
                <p><b>Email :</b> <?php echo $row['email']  ?></p>
                <p><b>Mobile no :</b> <?php echo $row['number'] ?></p>
                <p><b>Address :</b> <?php echo $row['address'] ?>,
                    <?php echo $row['city'] ?><br><?php echo $row['state'] ?>, <?php echo $row['zip'] ?>
                </p>

                <?php echo "<a href='?type=delete&id=" . $row['id'] . "' class='btn btn-primary'>Delete</a>&nbsp;&nbsp;";
                        echo "<a href='post.php?id=" . $row['id'] . "' class='btn btn-secondary'>Edit</a>";
                        ?>

            </div>
        </div>
    </div>
    <?php } ?>

</div>

<?php
    include('assets/footer.php'); ?>

<?php
} else {
    header("location:index.php?msg=not_allowed");
} ?>