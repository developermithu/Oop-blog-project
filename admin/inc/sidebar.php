 <div class="grid_2">
            <div class="box sidemenu">
                <div class="block" id="section-menu">
                    <ul class="section menu">

<!-- no one can access site option & pages without admin -->
<?php if (Session::get('userRole') == '0') { ?>

                       <li><a class="menuitem">Site Option</a>
                            <ul class="submenu">
                                <li><a href="titleslogan.php">Title & Slogan</a></li>
                                <li><a href="social.php">Social Media</a></li>
                                <li><a href="copyright.php">Copyright</a></li>
                                
                            </ul>
                        </li>
                         <li><a class="menuitem">Pages</a>
                            <ul class="submenu">
                                <li><a href="addpage.php">Add New Page</a> </li>
<?php 
    $query = "SELECT * FROM `tbl_page` ";
    $selected_rows = $db->select($query);
    if ($selected_rows) {
        while ($tbl_page = $selected_rows->fetch_assoc()) {
?>                                           
                        <li><a href="editpage.php?pagid=<?php echo $tbl_page['id'] ?>">
                            <?php echo $tbl_page['name'] ?></a></li>

<?php } } ?>
                            </ul>
                        </li>
<?php } ?> <!-- end session -->

                        <li><a class="menuitem">Category Option</a>
                            <ul class="submenu">
                                <li><a href="addcat.php">Add Category</a> </li>
                                <li><a href="catlist.php">Category List</a> </li>
                            </ul>
                        </li>
                        <li><a class="menuitem">Slider Option</a>
                            <ul class="submenu">
                                <li><a href="addslider.php">Add Slider</a> </li>
                                <li><a href="sliderlist.php">Slider List</a> </li>
                            </ul>
                        </li>
                        <li><a class="menuitem">Post Option</a>
                            <ul class="submenu">
                                <li><a href="addpost.php">Add Post</a> </li>
                                <li><a href="postlist.php">Post List</a> </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>