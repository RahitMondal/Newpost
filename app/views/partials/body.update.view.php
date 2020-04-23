<?php
    $phone='';$dob='';$address='';$about='';
    if($details=App::get('details')){
        $phone=$details['phone'];
        $dob=$details['dob'];
        $address=$details['address'];
        $about=$details['about'];
    }
?>
<form name="update_form" action="/update" method="POST" enctype="multipart/form-data">
    <input type="file" name="pic" placeholder="Profile Picture">
    <input type="text" name="phone" placeholder="Phone number" value=<?= "'{$phone}'" ?>>
    <input type="date" name="dob" placeholder="Date of birth" value=<?= "'{$dob}'" ?>>
    <input type="text" name="address" placeholder="Address" value=<?= "'{$address}'" ?>>
    <textarea name="about" placeholder="About yourself"><?= $about ?></textarea>
    <input type="submit" name="update_btn" value="Complete Profile">
</form>