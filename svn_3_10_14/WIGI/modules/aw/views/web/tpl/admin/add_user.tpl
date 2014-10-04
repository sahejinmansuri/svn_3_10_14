<form action="{$formbase}admin/adduser" method="get">

<ul class="filter">
<li>
	<p style="width:120px;"><strong>Login Id</strong> </p>
	<li><input type="text" name="login_id" value="" style="width:150px;"/></li>
</li>
</ul>

<ul class="filter">
<li>
	<p style="width:120px;"><strong>Email Address</strong> </p>
	<li><input type="text" name="email" value="" style="width:150px;"/></li>
</li>
</ul>

<ul class="filter">
<li>
	<p style="width:120px;"><strong>Confirm Email</strong> </p>
	<li><input type="text" name="email2" value="" style="width:150px;"/></li>
</li>
</ul>

<ul class="filter">
<li>
	<p style="width:120px;"><strong>Password</strong> </p>
	<li><input type="password" name="password" value="" style="width:90px;"/></li>
</li>
</ul>

<ul class="filter">
<li>
	<p style="width:120px;"><strong>Confirm Password</strong> </p>
	<li><input type="password" name="password2" value="" style="width:90px;"/></li>
</li>
</ul>

<ul class="filter">
<li>
	<p style="width:120px;"><strong>First Name</strong></p>
	<li><input type="text" name="firstname" value="" style="width:120px;"/></li>
</li>
</ul>

<ul class="filter">
<li>
	<p style="width:120px;"><strong>Last Name</strong></p>
	<li><input type="text" name="lastname" value="" style="width:120px;"/></li>
</li>
</ul>

<ul class="filter">
<li>
	<p style="width:120px;"><strong>Add Permissions (Role)</strong></p>
	{if $is_existing_roles}
	<li>
	<select name="permissions">
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
	<p style="width:120px;"><strong>Phone Number</strong></p>
	<li><input type="text" name="phone" value="" style="width:90px;"/></li>
</li>
</ul>

<div class="recrow ctr">
<input class="adminBtn" type="submit" value="Add User" />
</div>
</form>