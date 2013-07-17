<?php do_action( 'bp_before_group_invites_content' ) ?>

<?php if ( bp_has_groups( 'type=invites&user_id=' . bp_loggedin_user_id() ) ) : ?>

	<ul id="group-list" class="invites item-list">

		<?php while ( bp_groups() ) : bp_the_group(); ?>

			<li>
				
				<div class="item-avatar">
					
					<?php bp_group_avatar_thumb() ?>
					
				</div>

				<div class="item">
					
					<a class="item-title" href="<?php bp_group_permalink() ?>"><?php bp_group_name() ?></a>
					<span class="member-count"> - <?php printf( __( '%s members', 'buddypress' ), bp_group_total_members( false ) ) ?></span>
				
					<p class="desc">
						<?php bp_group_description_excerpt() ?>
					</p>
					
				</div>
				
				<?php do_action( 'bp_group_invites_item' ) ?>

				<div class="action">
					
					<a class="button accept" href="<?php bp_group_accept_invite_link() ?>"><?php _e( 'Accept', 'buddypress' ) ?></a> &nbsp;
					<a class="button reject confirm" href="<?php bp_group_reject_invite_link() ?>"><?php _e( 'Reject', 'buddypress' ) ?></a>

					<?php do_action( 'bp_group_invites_item_action' ) ?>
					
				</div>
				
				<div class="fix"></div>
				
			</li>

		<?php endwhile; ?>
	</ul>

<?php else: ?>

	<div id="message">
		<p class="woo-sc-box note"><?php _e( 'You have no outstanding group invites.', 'buddypress' ) ?></p>
	</div>

<?php endif;?>

<?php do_action( 'bp_after_group_invites_content' ) ?>