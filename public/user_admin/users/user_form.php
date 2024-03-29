<?php

// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if (!isset ($user)) {
    redirect(url_for('/user_admin/users/index.php'));
} 
?>

<dl>
<dt>First name</dt>
<dd><input type="text" name="user[first_name]" value="<?php echo h($user->first_name); ?>" /></dd>
</dl>

<dl>
<dt>Last name</dt>
<dd><input type="text" name="user[last_name]" value="<?php echo h($user->last_name); ?>" /></dd>
</dl>

<dl>
<dt>Email </dt>
<dd><input type="text" name="user[email]" value="<?php echo h($user->email); ?>" /><br /></dd>
</dl>

<dl>
<dt>Username</dt>
<dd><input type="text" name="user[username]" value="<?php echo h($user->username); ?>" /></dd>
</dl>

<dl>
<dt>User Type</dt>
<dd>
    <select name="user[user_type]">
    <?php foreach (User::TYPE as $t) { ?>
        <option value="<?php echo $t; ?>" <?php if ($user->user_type == $t) { echo 'selected'; } ?>><?php echo $t; ?></option>
    <?php } ?>
    </select>
</dd>
</dl>

<dl>
<dt>Password</dt>
<dd><input type="password" name="user[password]" value="" /></dd>
</dl>

<dl>
<dt>Confirm Password</dt>
<dd><input type="password" name="user[confirm_password]" value="" /></dd>
</dl>
<p>
Passwords should be at least 12 characters and include at least one uppercase letter, lowercase letter, number, and symbol.
</p>