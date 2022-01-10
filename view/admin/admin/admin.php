<?php

include "view/layout/admin/header.php";

if (isset($_GET['edit'])) {
    include "view/admin/admin/edit.php";
} else if (isset($_GET['create'])) {
    include "view/admin/admin/create.php";
} else {
    include "view/admin/admin/index.php";
}

include "view/layout/admin/footer.php";
