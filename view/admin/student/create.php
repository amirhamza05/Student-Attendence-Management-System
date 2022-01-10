<div class="row">
    <div class="col-md-6">
        <?php lib()->formResponse(); ?>
        <form action="api/student.php" method="post">
            <div class="form-group">
                <label>Student Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Student Name">
            </div>

            <div class="form-group">
                <label>Student Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Student Email">
            </div>
            <div class="form-group">
                <label>Student Mobile</label>
                <input type="text" name="student_mobile" class="form-control" placeholder="Enter Student Mobile">
            </div>

            <button type="submit" name="create" class="btn btn-primary">Create Student</button>
        </form>

    </div>
</div>