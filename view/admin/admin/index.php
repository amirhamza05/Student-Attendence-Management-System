<?php
$users = user()->all();

?>

<?php lib()->formResponse(); ?>
<div class="float-right" style="margin-bottom: 15px;">
  <a href="?create=true" class="btn btn-primary">Create Student</a>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Admin Name</th>
      <th scope="col">Admin Email</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $key => $user) { 
      if($user['user_type'] == "student")continue;
      ?>
      <tr>
        <th scope="row"><?php echo $user['user_id']; ?></th>
        <td><?php echo $user['name']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td style="text-align: center;">
          <a href="?edit=<?php echo $user['user_id']; ?>" class="btn btn-sm btn-success">Edit</a>
          <?php if(auth()->user()['user_id'] != $user['user_id']){ ?>
          <button onclick="deletePermission(<?php echo $user['user_id']; ?>)" class="btn btn-sm btn-danger">Delete</button>
        <?php } ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<script type="text/javascript">
  function deletePermission(userId){
    let ok = confirm("Are you want to delete this user?");
    if(!ok)return;
    window.location = "api/admin.php?delete="+userId;
  }
</script>