<?php

include "view/layout/admin/header.php";

if (isset($_GET['edit'])) {
    include "view/admin/student/edit.php";
} else if (isset($_GET['create'])) {
    include "view/admin/student/create.php";
} else if (isset($_GET['show'])) {
   echo "view/admin/course/show.php";
} else {
    include "view/admin/student/index.php";
}


include "view/layout/admin/footer.php";
