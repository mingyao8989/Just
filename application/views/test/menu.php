<html>
<head><title>Test web service</title></head>
<body>

<style>
<!--
h1 {
margin-bottom: 0;
}
ul {
margin-top: 0;
}
-->
</style>



<h1>USER PROFILE</h1>
<ul>
	<li><a href="<?= current_url()?>/users/login_facebook">Login by Facebook</a></li>
	<li><a href="<?= current_url()?>/users/login_twitter">Login by Twitter</a></li>
	
	<li><a href="<?= current_url()?>/users/get_profile">Get Profile</a></li>
	<li><a href="<?= current_url()?>/users/edit_profile">Edit Profile</a></li>
	
	<li><a href="<?= current_url()?>/users/get_account">Get Account</a></li>
	<li><a href="<?= current_url()?>/users/edit_account">Edit Account</a></li>
	
	<li><a href="<?= current_url()?>/users/get_notifications">Get Notifications</a></li>
	<li><a href="<?= current_url()?>/users/edit_notifications">Edit Notifications</a></li>
	
	<li><a href="<?= current_url()?>/users/chagne_avatar">Change Avatar</a></li>
	<li><a href="<?= current_url()?>/users/logout">Logout</a></li>
</ul>

<h1>POST</h1>
<ul>
	<li><a href="<?= current_url()?>/posts/get_tags">Get Tags</a></li>
	<li><a href="<?= current_url()?>/posts/uploadfile">Upload File</a></li>
	<li><a href="<?= current_url()?>/posts/newpost">New Post</a></li>
	<li><a href="<?= current_url()?>/posts/get_latest">Get Latest</a></li>
	<li><a href="<?= current_url()?>/posts/get_newsfeed">Get Newfeed</a></li>
	<li><a href="<?= current_url()?>/posts/get_notifications">Get Notifications</a></li>
	<li><a href="<?= current_url()?>/posts/view_post">View Post</a></li>
	<li><a href="<?= current_url()?>/posts/get_replies">Get Replies</a></li>
	<li><a href="<?= current_url()?>/posts/resays">Resays</a></li>
	<li><a href="<?= current_url()?>/posts/like">Like</a></li>
	<li><a href="<?= current_url()?>/posts/unlike">UnLike</a></li>
</ul>



<h1>PEOPLE</h1>
<ul>
	<li><a href="<?= current_url()?>/people/find_facebook_friend">Find My Facebook Frind</a></li>
	<li><a href="<?= current_url()?>/people/find_twitter_friend">Find My Twitter Frind</a></li>
	<li><a href="<?= current_url()?>/people/follow">Follow</a></li>
	<li><a href="<?= current_url()?>/people/unfollow">UnFollow</a></li>
	<li><a href="<?= current_url()?>/people/find_users">Find Users</a></li>
</ul>

</body>
</html>

