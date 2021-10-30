<?php include './includes/modal_delete_user.php'; ?>

<h3> View all users </h3>

<?php $MSG_STATUS = ''; ?>
<?php if (isset($_GET['msg'])) $MSG_STATUS = $_GET['msg']; ?>

<?php if (!empty($MSG_STATUS)) echo "<br> <p class='my-status-msg-box'> <i>" . $MSG_STATUS . "</i> </p> <br>"; ?>

<table class="table table-bordered table-hover" style="text-align:center">

    <thead>
        <tr>
            <th style="text-align:center"> Id </th>
            <th style="text-align:center"> Username </th>
            <th style="text-align:center"> First Name </th>
            <th style="text-align:center"> Last Name </th>
            <th style="text-align:center"> Email </th>
            <th style="text-align:center"> Image </th>
            <th style="text-align:center"> Posts </th>
            <th style="text-align:center"> Role </th>
            <th style="text-align:center"> Delete </th>
            <th style="text-align:center"> Edit </th>
        </tr>
    </thead>

    <tbody>
        <?php display_all_users_on_table(); ?>
    </tbody>

</table>