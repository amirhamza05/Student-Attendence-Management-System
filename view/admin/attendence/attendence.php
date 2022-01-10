<?php

include "view/layout/admin/header.php";

if(isset($_GET['edit'])){
  include "view/admin/course/edit.php";
}
else if(isset($_GET['create'])){
  include "view/admin/course/create.php";
}
else if(isset($_GET['show'])){
  include "view/admin/course/show.php";
}
else include "view/admin/attendence/index.php";


include "view/layout/admin/footer.php";
