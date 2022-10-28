<?php
	$role = get_post_meta( get_the_ID(), 'qodef_team_member_role', true);

	if( ! empty($role) ){
?>
	<h6 class="qodef-e-role">
		<?php echo strip_tags( $role ); ?>
	</h6>
<?php } ?>
