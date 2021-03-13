   <div class="clear">
    </div>
    <div id="site_info">
        <p>
<?php 
    $query = "SELECT * FROM `tbl_copy` WHERE `id` = 1 ";  //id always 1
    $result = $db->select($query);
    if ($result) {
        while ($copyright = $result->fetch_assoc()) {    

 ?>       	
        <center style="padding:6px 0"> &copy; Copyright <a href="#"><?php echo $copyright['text'] ;?></a>. All Rights Reserved.</center>

<?php } } ?> 

        </p>  
 </div>
</body>
</html>
