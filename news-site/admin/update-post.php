<?php include "header.php"; ?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <?php
           include "config.php";

           $post_id = $_GET['id'];
           $sql = "SELECT * FROM post
                   LEFT JOIN category ON post.category = category.category_id
                   LEFT JOIN user ON post.author = user.user_id
                   WHERE post.post_id = {$post_id}";

            $result = mysqli_query($conn,$sql) or die("Query Failed.");
            if(mysqli_num_rows($result) > 0){
               while($row = mysqli_fetch_assoc($result)){
               $img_path = "upload/".$row['post_img'];
        ?>
        <!-- Form for show edit-->
        <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row['post_id']; ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5"><?php echo $row['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                    <?php
                                  include "config.php";
                                  $sql = "SELECT * FROM category";
                                  $result = mysqli_query($conn,$sql)or die('Query Failed');

                                  if(mysqli_num_rows($result) > 0){
                                     while($row = mysqli_fetch_assoc($result)){
                                       echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
                                     }
                                  }  
                              ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="<?php echo $img_path ?>" alt="An Image" height="150px">
                <!--<input type="hidden" name="old-image" value="">-->
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->
        <?php
          }
        }else{
           echo "Result Not Found.";
        } ?>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
