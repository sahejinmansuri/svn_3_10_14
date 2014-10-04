<form action="{$formbase}admin/adduser" method="post">
<ul class="filter">
<li>
	<p class="width150"><strong>Email Address</strong> </p>
	<li><input type="text" name="email" value="" style="width:150px;"/></li>
</li>
</ul>

<ul class="filter">
<li>
	<p class="width150"><strong>Confirm Email</strong> </p>
	<li><input type="text" name="email2" value="" style="width:150px;"/></li>
</li>
</ul>

<ul class="filter">
<li>
	<p class="width150"><strong>Password</strong> </p>
	<li><input type="password" name="password" value="" style="width:90px;"/></li>
</li>
</ul>

<ul class="filter">
<li>
	<p class="width150"><strong>Confirm Password</strong> </p>
	<li><input type="password" name="password2" value="" style="width:90px;"/></li>
</li>
</ul>

<ul class="filter">
<li>
	<p class="width150"><strong>First Name</strong></p>
	<li><input type="text" name="first_name" value="" class="width150"/></li>
</li>
</ul>

<ul class="filter">
<li>
	<p class="width150"><strong>Last Name</strong></p>
	<li><input type="text" name="last_name" value="" class="width150"/></li>
</li>
</ul>

<ul class="filter">
<li>
	<p class="width150"><strong>Add Permissions (Role)</strong></p>
	{if $is_existing_roles}
	<li>
	<select name="role">
	<option value="" selected="selected">Select</option>
	{foreach from=$existing_roles item=data}
	<option value="{$data.rolename}">{$data.rolename}</option>
	{/foreach}
	</select>
	</li>
	{else}
	<li>No Roles Available. Please add a Role.</li>	
	{/if}
</li>
</ul>

<ul class="filter">
<li>
	<p class="width150"><strong>Phone Number</strong></p>
	<li><input type="text" name="phone" value="" style="width:90px;"/></li>
</li>
</ul>

<!--<ul class="filter">
<li>
	<p class="width150"><strong>User Type</strong></p>
	<li><input type="text" name="user_type" value="web" disabled style="width:90px;"/></li>
</li>
</ul>-->

<div class="recrow ctr">
    <input class="adminBtn" type="submit" value="Add User" />
</div>

</form>