
<?php
  $name=time()."_AXIXA_".$_FILES['upfiles']['name'];
 move_uploaded_file($_FILES['upfiles']['tmp_name'],'files/'.$name);
// print_R($_FILES);
?>