  <div class="menu-layer">
    <ul>
	<?php
		if($_SESSION['admin_status'] == '1'){
    ?>	
      <li data-open-after="true"> <a href="index.php">Dashboard</a> </li>
	<?php } ?>

      <li> <a href="javascript:;">Groups</a>
        <ul class="child-menu">
          <li><a href="groups.php">All Groups</a></li>
          <li><a href="add-group.php">Add New</a></li>
        </ul>
      </li>
      <li><a href="manage-user.php?user_type=all"> Manage Users</a></li>
      <li> <a href="javascript:;">Sadhu/Sadhvi</a>
        <ul class="child-menu">
         <!-- <li><a href="users.php?user_type=all">All Users</a></li>-->
          <li><a href="users.php?user_type=Sadhu">Sadhu's</a></li>
          <li><a href="users.php?user_type=Sadhvi">Sadhvi's</a></li>
          <li><a href="add-user.php">Add New</a></li>
        </ul>
      </li>
	 <li> <a href="javascript:;">Dadawadi</a>
        <ul class="child-menu">
          <li><a href="dadawadi.php">All Dadawadi</a></li>
          <li><a href="add-dadawadi.php">Add New</a></li>
        </ul>
     </li>
     <li> <a href="javascript:;">Tirth</a>
        <ul class="child-menu">
          <li><a href="tirth.php">All Tirth</a></li>
          <li><a href="add-tirth.php">Add New</a></li>
        </ul>
      </li>
	<li> <a href="javascript:;">Events</a>
        <ul class="child-menu">
          <li><a href="events.php">All Events</a></li>
          <li><a href="add-event.php">Add New</a></li>
        </ul>
      </li>

	<li> <a href="javascript:;">Photo Gallery</a>
        <ul class="child-menu">
          <li><a href="photo-gallery.php">All Gallery</a></li>
          <li><a href="add-photo-gallery.php">Add New</a></li>
        </ul>
      </li>
      
     <li> <a href="javascript:;">Video Gallery</a>
        <ul class="child-menu">
          <li><a href="video_gallery.php">All Gallery</a></li>
          <li><a href="add_video_gallery.php">Add New</a></li>
        </ul>
      </li>

	<li> <a href="javascript:;">Stavan Sangrah</a>
        <ul class="child-menu">
          <li><a href="stavan-sangrah.php">All Stavan Sangrah</a></li>
          <li><a href="add-stavan-sangrah.php">Add New</a></li>
        </ul>
      </li>
      
      <li> <a href="javascript:;">Panchang</a>
        <ul class="child-menu">
          <li><a href="panchang.php">All Panchang</a></li>
          <li><a href="add-panchang.php">Add Panchang</a></li>
        </ul>
      </li>
      
      <li> <a href="logout.php">Logout</a>
    </ul>
</div>
