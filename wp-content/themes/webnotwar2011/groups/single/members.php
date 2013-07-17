<?php if ( bp_group_has_members( 'exclude_admins_mods=0' ) ) : ?>

	<?php do_action( 'bp_before_group_members_content' ) ?>
	
	<div class="fix"></div>
	
	<div class="member-pag pagination no-ajax">

		<div id="member-count" class="pag-count">
			<?php bp_group_member_pagination_count() ?>
		</div>

		<div id="member-pagination" class="pagination-links">
			<?php bp_group_member_pagination() ?>
		</div>
		
		<div class="fix"></div>
		
	</div>
	
	<div class="fix"></div>

	<?php do_action( 'bp_before_group_members_list' ) ?>

	<ul id="member-list" class="item-list">
		<?php while ( bp_group_members() ) : bp_group_the_member(); ?>

			<li>
				<div class="item-avatar">
					<a href="<?php bp_group_member_domain() ?>">
						<?php bp_group_member_avatar_thumb() ?>
					</a>
				</div>
				
				<div class="item">
					<div class="item-title"><?php bp_group_member_link() ?></div>
				</div>

				<?php do_action( 'bp_group_members_list_item' ) ?>

				<div class="action">
					<span class="activity"><?php bp_group_member_joined_since() ?></span>
					<?php if ( function_exists( 'friends_install' ) ) : ?>
						<?php bp_add_friend_button( bp_get_group_member_id(), bp_get_group_member_is_friend() ) ?>
						<?php do_action( 'bp_group_members_list_item_action' ) ?>
					<?php endif; ?>
				</div>

				<div class="fix"></div>
				
			</li>

		<?php endwhile; ?>

	</ul>

	<?php do_action( 'bp_after_group_members_content' ) ?>

<?php else: ?>

	<div id="message">
		<p class="woo-sc-box note"><?php _e( 'This group has no members.', 'buddypress' ); ?></p>
	</div>

<?php endif; ?>
