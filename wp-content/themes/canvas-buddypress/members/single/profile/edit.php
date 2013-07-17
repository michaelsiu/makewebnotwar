<?php do_action( 'bp_before_profile_edit_content' ) ?>

<?php if ( bp_has_profile( 'profile_group_id=' . bp_get_current_profile_group_id() ) ) : while ( bp_profile_groups() ) : bp_the_profile_group(); ?>

<form action="<?php bp_the_profile_group_edit_form_action() ?>" method="post" id="profile-edit-form" class="standard-form <?php bp_the_profile_group_slug() ?>">

	<?php do_action( 'bp_before_profile_field_content' ) ?>

		<h4><?php printf( __( "Editing '%s' Profile Group", "buddypress" ), bp_get_the_profile_group_name() ); ?></h4>

		<ul class="button-nav">
			<?php bp_profile_group_tabs(); ?>
		</ul>

		<div class="clear"></div>

		<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>

			<div<?php bp_field_css_class( 'editfield' ) ?>>

				<?php if ( 'textbox' == bp_get_the_profile_field_type() ) : ?>
				
					<div class="main-label">
					
						<label for="<?php bp_the_profile_field_input_name() ?>"><?php bp_the_profile_field_name() ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ) ?><?php endif; ?></label>
					
					</div><!-- /main-label -->
					
					<div class="controls text">
						
						<input type="text" name="<?php bp_the_profile_field_input_name() ?>" id="<?php bp_the_profile_field_input_name() ?>" value="<?php bp_the_profile_field_edit_value() ?>" />
						
					</div><!-- /controls -->

				<?php endif; ?><!-- END TEXTBOX -->

				<?php if ( 'textarea' == bp_get_the_profile_field_type() ) : ?>
				
					<div class="main-label">
					
						<label for="<?php bp_the_profile_field_input_name() ?>"><?php bp_the_profile_field_name() ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ) ?><?php endif; ?></label>
					
					</div><!-- /main-label -->
					
					<div class="controls textarea">
					
						<textarea rows="5" cols="40" name="<?php bp_the_profile_field_input_name() ?>" id="<?php bp_the_profile_field_input_name() ?>"><?php bp_the_profile_field_edit_value() ?></textarea>
					
					</div><!-- /controls -->
					
				<?php endif; ?><!-- END TEXTAREA -->

				<?php if ( 'selectbox' == bp_get_the_profile_field_type() ) : ?>
				
					<div class="main-label">
					
						<label for="<?php bp_the_profile_field_input_name() ?>"><?php bp_the_profile_field_name() ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ) ?><?php endif; ?></label>
					
					</div><!-- /main-label -->
					
					<div class="controls select">
					
						<select name="<?php bp_the_profile_field_input_name() ?>" id="<?php bp_the_profile_field_input_name() ?>">
							<?php bp_the_profile_field_options() ?>
						</select>
					
					</div><!-- /controls -->

				<?php endif; ?><!-- END SELECTBOX -->

				<?php if ( 'multiselectbox' == bp_get_the_profile_field_type() ) : ?>
				
					<div class="main-label">
					
						<label for="<?php bp_the_profile_field_input_name() ?>"><?php bp_the_profile_field_name() ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ) ?><?php endif; ?></label>
					
					</div><!-- /main-label -->
					
					<div class="controls multi-select">
					
						<select name="<?php bp_the_profile_field_input_name() ?>" id="<?php bp_the_profile_field_input_name() ?>" multiple="multiple">
							<?php bp_the_profile_field_options() ?>
						</select>
					
					</div><!-- /controls -->
					
				<?php endif; ?><!-- END MULTISELECT -->

				<?php if ( 'radio' == bp_get_the_profile_field_type() ) : ?>
				
					<div class="main-label">
					
						<span><?php bp_the_profile_field_name() ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ) ?><?php endif; ?></span>
					
					</div><!-- /main-label -->
					
					<div class="controls radio">
						
						<?php bp_the_profile_field_options() ?>
						
						<?php if ( !bp_get_the_profile_field_is_required() ) : ?>
							<a class="clear-value" href="javascript:clear( '<?php bp_the_profile_field_input_name() ?>' );"><?php _e( 'Clear', 'buddypress' ) ?></a>
						<?php endif; ?>
						
					</div><!-- /controls -->

				<?php endif; ?><!-- END RADIO -->

				<?php if ( 'checkbox' == bp_get_the_profile_field_type() ) : ?>
				
					<div class="main-label">
					
						<span><?php bp_the_profile_field_name() ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ) ?><?php endif; ?></span>
					
					</div><!-- /main-label -->
					
					<div class="controls checkbox">
					
						<?php bp_the_profile_field_options() ?>
					
					</div><!-- /controls -->
					
				<?php endif; ?><!-- END CHECKBOX -->

				<?php if ( 'datebox' == bp_get_the_profile_field_type() ) : ?>
				
					<div class="main-label">
					
						<label for="<?php bp_the_profile_field_input_name() ?>_day"><?php bp_the_profile_field_name() ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ) ?><?php endif; ?></label>
					
					</div><!-- /main-label -->
					
					<div class="controls date">
					
						<select name="<?php bp_the_profile_field_input_name() ?>_day" id="<?php bp_the_profile_field_input_name() ?>_day">
							<?php bp_the_profile_field_options( 'type=day' ) ?>
						</select>

						<select name="<?php bp_the_profile_field_input_name() ?>_month" id="<?php bp_the_profile_field_input_name() ?>_month">
							<?php bp_the_profile_field_options( 'type=month' ) ?>
						</select>

						<select name="<?php bp_the_profile_field_input_name() ?>_year" id="<?php bp_the_profile_field_input_name() ?>_year">
							<?php bp_the_profile_field_options( 'type=year' ) ?>
						</select>
					
					</div><!-- /controls -->
					
				<?php endif; ?><!-- END DATE -->

				<?php do_action( 'bp_custom_profile_edit_fields' ) ?>

				<div class="description">
					<p><?php bp_the_profile_field_description() ?></p>
				</div>
				
				<div class="fix"></div>
				
			</div>

		<?php endwhile; ?>

	<?php do_action( 'bp_after_profile_field_content' ) ?>

	<div class="submit">
		<input type="submit" name="profile-group-edit-submit" class="button" id="profile-group-edit-submit" value="<?php _e( 'Save Changes', 'buddypress' ) ?> " />
	</div>

	<input type="hidden" name="field_ids" id="field_ids" value="<?php bp_the_profile_group_field_ids() ?>" />
	<?php wp_nonce_field( 'bp_xprofile_edit' ) ?>

</form>

<?php endwhile; endif; ?>

<?php do_action( 'bp_after_profile_edit_content' ) ?>