<?php
/**
 * UABB Button Module front-end CSS php file
 *
 * @package UABB Button Module
 */

$version_bb_check = UABB_Compatibility::Check_BB_Version();
$converted        = UABB_Compatibility::Check_Old_Page_Migration();

$settings->bg_color                  = UABB_Helper::uabb_colorpicker( $settings, 'bg_color', true );
$settings->bg_hover_color            = UABB_Helper::uabb_colorpicker( $settings, 'bg_hover_color', true );
$settings->text_color                = UABB_Helper::uabb_colorpicker( $settings, 'text_color' );
$settings->text_hover_color          = UABB_Helper::uabb_colorpicker( $settings, 'text_hover_color' );
$settings->subtitle_text_color       = UABB_Helper::uabb_colorpicker( $settings, 'subtitle_text_color' );
$settings->subtitle_text_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'subtitle_text_hover_color' );
$settings->icon_color                = UABB_Helper::uabb_colorpicker( $settings, 'icon_color' );
?>
<?php if ( 'top' === $settings->icon_vertical_align ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-marketing-button-icon.uabb-marketing-button-icon-all_before,
	.fl-node-<?php echo $id; ?> .uabb-marketing-button-icon.uabb-marketing-button-icon-all_after {
		align-self: flex-start;
	}
<?php } ?>
<?php if ( 'all_before' === $settings->icon_position || 'all_after' === $settings->icon_position ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-button-width-custom .uabb-button {
		display: inline-flex;
		text-align: center;
		max-width: 100%;
		justify-content: center;
		align-items: center;
	}
<?php } ?>
.fl-node-<?php echo $id; ?> .uabb-align-icon-all_before {
	float: left;
	align-self: center;
}
.fl-node-<?php echo $id; ?> .uabb-align-icon-all_after {
	float: right;
	align-self: center;
}
.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap-all_before {
	display: inline-flex;
}

.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap-all_after {
	display: inline-flex;
	flex-direction: row-reverse;
}
<?php if ( ! $version_bb_check ) { ?>
	<?php
	$settings->font_family = (array) $settings->font_family;
	?>

	.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title,
	.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title:visited{
		<?php if ( 'default' !== $settings->font_family['family'] && 'default' !== $settings->font_family['weight'] ) : ?>
			<?php FLBuilderFonts::font_css( $settings->font_family ); ?>
		<?php endif; ?>
		<?php
		if ( isset( $settings->font_size_unit ) ) {
			echo ( '' !== $settings->font_size_unit ) ? 'font-size:' . $settings->font_size_unit . 'px;' : '';
		}
		if ( isset( $settings->line_height_unit ) ) {
				echo ( '' !== $settings->line_height_unit ) ? 'line-height:' . $settings->line_height_unit . 'em;' : '';
		}
		if ( isset( $settings->letter_spacing ) ) {
			echo ( '' !== $settings->letter_spacing ) ? 'letter-spacing:' . $settings->letter_spacing . 'px;' : '';
		}
		if ( isset( $settings->transform ) ) {
			echo ( '' !== $settings->transform ) ? 'text-transform:' . $settings->transform . ';' : '';
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule( array(
			'settings'     => $settings,
			'setting_name' => 'button_typo',
			'selector'     => ".fl-node-$id .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title, .fl-node-$id .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title:visited",
		));
	}
}
?>
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading,
	.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading:visited {
		<?php if ( 'default' !== $settings->subtitle_font_family['family'] && 'default' !== $settings->subtitle_font_family['weight'] ) : ?>
			<?php FLBuilderFonts::font_css( $settings->subtitle_font_family ); ?>
		<?php endif; ?>
		<?php
		if ( isset( $settings->subtitle_font_size_unit ) ) {
			echo ( '' !== $settings->subtitle_font_size_unit ) ? 'font-size:' . $settings->subtitle_font_size_unit . 'px;' : '';
		}
		if ( isset( $settings->subtitle_line_height_unit ) ) {
				echo ( '' !== $settings->subtitle_line_height_unit ) ? 'line-height:' . $settings->subtitle_line_height_unit . 'em;' : '';
		}
		if ( isset( $settings->subtitle_letter_spacing ) ) {
			echo ( '' !== $settings->subtitle_letter_spacing ) ? 'letter-spacing:' . $settings->subtitle_letter_spacing . 'px;' : '';
		}
		if ( isset( $settings->subtitle_transform ) ) {
			echo ( '' !== $settings->subtitle_transform ) ? 'text-transform:' . $settings->subtitle_transform . ';' : '';
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule( array(
			'settings'     => $settings,
			'setting_name' => 'button_typo_subtitle',
			'selector'     => ".fl-node-$id .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading, .fl-node-$id .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading:visited",
		));
	}
}
?>
.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link,
.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link:visited {
	<?php
	if ( isset( $settings->padding_top ) && isset( $settings->padding_right ) && isset( $settings->padding_bottom ) && isset( $settings->padding_left ) ) {
		if ( isset( $settings->padding_top ) ) {
			echo ( '' !== $settings->padding_top ) ? 'padding-top:' . $settings->padding_top . 'px;' : 'padding-top:10px;';
		}
		if ( isset( $settings->padding_right ) ) {
			echo ( '' !== $settings->padding_right ) ? 'padding-right:' . $settings->padding_right . 'px;' : 'padding-right:40px;';
		}
		if ( isset( $settings->padding_bottom ) ) {
			echo ( '' !== $settings->padding_bottom ) ? 'padding-bottom:' . $settings->padding_bottom . 'px;' : 'padding-bottom:10px;';
		}
		if ( isset( $settings->padding_left ) ) {
			echo ( '' !== $settings->padding_left ) ? 'padding-left:' . $settings->padding_left . 'px;' : 'padding-left:40px;';
		}
	}
	if ( isset( $settings->border_radius ) ) {
		echo ( '' !== $settings->border_radius ) ? 'border-radius:' . $settings->border_radius . 'px;' : '';
	}
	if ( 'custom' === $settings->width ) {
		if ( isset( $settings->custom_width ) ) {
			echo ( '' !== $settings->custom_width ) ? 'width:' . $settings->custom_width . 'px;' : '';
		}
		if ( isset( $settings->custom_height ) ) {
			echo ( '' !== $settings->custom_height ) ? 'min-height:' . $settings->custom_height . 'px;' : '';
		}
	}
	?>
}
<?php if ( 'custom' === $settings->width ) { ?>
	html.internet-explorer .fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link,
	html.internet-explorer .fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link:visited {
		line-height: <?php echo $settings->custom_height; ?>px;
	}
<?php } ?>

<?php if ( ! empty( $settings->text_color ) ) { ?>
.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title,
.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title *,
.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title:visited,
.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title:visited * {
	color: <?php echo $settings->text_color; ?>;
}
<?php } ?>
<?php if ( ! empty( $settings->subtitle_text_color ) ) { ?>
.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading,
.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading *,
.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading:visited,
.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading:visited * {
	color: <?php echo $settings->subtitle_text_color; ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->bg_hover_color ) && 'gradient' !== $settings->style ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-button:hover {
		background: <?php echo $settings->bg_hover_color; ?>;
	}
<?php } ?>

<?php if ( ! empty( $settings->text_hover_color ) ) : ?>
.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title:hover,
.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title:hover * {
	color: <?php echo $settings->text_hover_color; ?>;
}
<?php endif; ?>
<?php if ( ! empty( $settings->subtitle_text_hover_color ) ) : ?>
.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading:hover,
.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading:hover * {
	color: <?php echo $settings->subtitle_text_hover_color; ?>;
}
<?php endif; ?>
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link, .uabb-marketing-button-wrap .uabb-marketing-btn__link:visited {
	<?php
	if ( isset( $settings->border_style ) ) {
		echo ( '' !== $settings->border_style ) ? 'border-style:' . $settings->border_style . ';' : '';
	}
	if ( isset( $settings->border_size ) ) {
		echo ( '' !== $settings->border_size ) ? 'border-width:' . $settings->border_size . 'px;' : '';
	}
	if ( isset( $settings->border_color ) ) {
		echo ( '' !== $settings->border_color ) ? 'border-color:' . $settings->border_color . ';' : '';
	}
	?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		// Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'border',
				'selector'     => ".fl-node-$id .uabb-marketing-button-wrap .uabb-marketing-btn__link,.fl-node-$id .uabb-marketing-button-wrap .uabb-marketing-btn__link:visited",
			)
		);
	}
}
?>
<?php // Button Style. ?>
.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link,
.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link:visited {
	<?php
	if ( 'flat' === $settings->style ) {
		echo ( '' !== $settings->bg_color ) ? 'background:' . $settings->bg_color . ';' : '';
	} elseif ( 'transparent' === $settings->style ) {
		echo 'background:' . 'transparent;';
	} elseif ( $version_bb_check ) {
		if ( 'gradient' === $settings->style ) {
		?>
		background:<?php echo FLBuilderColor::gradient( $settings->gradient ); ?>;
		<?php
		}
	}
	?>
}
.fl-node-<?php echo $id; ?> .uabb-marketing-button .uabb-marketing-title {
	<?php
	if ( isset( $settings->title_margin_bottom ) ) {
		echo ( '' !== $settings->title_margin_bottom ) ? 'margin-bottom:' . $settings->title_margin_bottom . 'px;' : '';
	}
	?>
}
.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-button .uabb-button-icon {
	<?php
	if ( isset( $settings->icon_width ) ) {
		echo ( '' !== $settings->icon_width ) ? 'font-size:' . $settings->icon_width . 'px;' : '';
	}
	if ( isset( $settings->icon_color ) ) {
		echo ( '' !== $settings->icon_color ) ? 'color:' . $settings->icon_color . '' : '';
	}
	?>
}
<?php if ( 'before' === $settings->icon_position || 'all_before' === $settings->icon_position ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-marketing-button-icon.uabb-marketing-button-icon-all_before,
	.fl-node-<?php echo $id; ?> .uabb-marketing-buttons-icon-innerwrap.uabb-marketing-button-icon-before {
		<?php
		if ( isset( $settings->img_icon_spacing ) ) {
			echo ( '' !== $settings->img_icon_spacing ) ? 'margin-right:' . $settings->img_icon_spacing . 'px;' : '';
			echo 'margin-left:0;';
		}
		?>
	}
<?php
} elseif ( 'after' === $settings->icon_position || 'all_after' === $settings->icon_position ) {
	?>
	.fl-node-<?php echo $id; ?> .uabb-marketing-button-icon.uabb-marketing-button-icon-all_after,
	.fl-node-<?php echo $id; ?> .uabb-marketing-buttons-icon-innerwrap.uabb-marketing-button-icon-after {
		<?php
		if ( isset( $settings->img_icon_spacing ) ) {
			echo ( '' !== $settings->img_icon_spacing ) ? 'margin-left:' . $settings->img_icon_spacing . 'px;' : '';
			echo 'margin-right:0;';
		}
		?>
	}
<?php } ?>
<?php if ( $global_settings->responsive_enabled ) { ?>
	@media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {
		.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link,
		.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link:visited {
			<?php
			if ( isset( $settings->padding_top_medium ) && isset( $settings->padding_right_medium ) && isset( $settings->padding_bottom_medium ) && isset( $settings->padding_left_medium ) ) {
				if ( isset( $settings->padding_top_medium ) ) {
					echo ( '' !== $settings->padding_top_medium ) ? 'padding-top:' . $settings->padding_top_medium . 'px;' : 'padding-top:10px;';
				}
				if ( isset( $settings->padding_right_medium ) ) {
					echo ( '' !== $settings->padding_right_medium ) ? 'padding-right:' . $settings->padding_right_medium . 'px;' : 'padding-right:40px;';
				}
				if ( isset( $settings->padding_bottom_medium ) ) {
					echo ( '' !== $settings->padding_bottom_medium ) ? 'padding-bottom:' . $settings->padding_bottom_medium . 'px;' : 'padding-bottom:10px;';
				}
				if ( isset( $settings->padding_left_medium ) ) {
					echo ( '' !== $settings->padding_left_medium ) ? 'padding-left:' . $settings->padding_left_medium . 'px;' : 'padding-left:40px;';
				}
			}
			?>
		}
		<?php if ( $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title,
			.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title:visited {
				<?php
				if ( isset( $settings->font_size_unit_medium ) ) {
					echo ( '' !== $settings->font_size_unit_medium ) ? 'font-size:' . $settings->font_size_unit_medium . 'px;' : '';
				}
				if ( isset( $settings->line_height_unit_medium ) ) {
						echo ( '' !== $settings->line_height_unit_medium ) ? 'line-height:' . $settings->line_height_unit . 'em;' : '';
				}
				?>
			}
			.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading,
			.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading:visited {
				<?php
				if ( isset( $settings->subtitle_font_size_unit_medium ) ) {
					echo ( '' !== $settings->subtitle_font_size_unit_medium ) ? 'font-size:' . $settings->font_size_unit_medium . 'px;' : '';
				}
				if ( isset( $settings->subtitle_line_height_unit_medium ) ) {
						echo ( '' !== $settings->subtitle_line_height_unit_medium ) ? 'line-height:' . $settings->subtitle_line_height_unit . 'em;' : '';
				}
				?>
			}
		<?php } ?>
	}
	@media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {
		.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap.uabb-marketing-button-reponsive-<?php echo $settings->mob_align; ?> {
			text-align: <?php echo $settings->mob_align; ?>;
		}
		.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link,
		.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link:visited {
			<?php
			if ( isset( $settings->padding_top_responsive ) && isset( $settings->padding_right_responsive ) && isset( $settings->padding_bottom_responsive ) && isset( $settings->padding_left_responsive ) ) {
				if ( isset( $settings->padding_top_responsive ) ) {
					echo ( '' !== $settings->padding_top_responsive ) ? 'padding-top:' . $settings->padding_top_responsive . 'px;' : 'padding-top:10px;';
				}
				if ( isset( $settings->padding_right_responsive ) ) {
					echo ( '' !== $settings->padding_right_responsive ) ? 'padding-right:' . $settings->padding_right_responsive . 'px;' : 'padding-right:40px;';
				}
				if ( isset( $settings->padding_bottom_responsive ) ) {
					echo ( '' !== $settings->padding_bottom_responsive ) ? 'padding-bottom:' . $settings->padding_bottom_responsive . 'px;' : 'padding-bottom:10px;';
				}
				if ( isset( $settings->padding_left_responsive ) ) {
					echo ( '' !== $settings->padding_left_responsive ) ? 'padding-left:' . $settings->padding_left_responsive . 'px;' : 'padding-left:40px;';
				}
			}
			?>
		}
		.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title,
		.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title:visited {
			<?php
			if ( isset( $settings->font_size_unit_responsive ) ) {
				echo ( '' !== $settings->font_size_unit_responsive ) ? 'font-size:' . $settings->font_size_unit_responsive . 'px;' : '';
			}
			if ( isset( $settings->line_height_unit_responsive ) ) {
				echo ( '' !== $settings->line_height_unit_responsive ) ? 'line-height:' . $settings->line_height_unit_responsive . 'em;' : '';
			}
			?>
		}
		.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading,
		.fl-node-<?php echo $id; ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading:visited {
			<?php
			if ( isset( $settings->subtitle_font_size_unit_responsive ) ) {
				echo ( '' !== $settings->subtitle_font_size_unit_responsive ) ? 'font-size:' . $settings->subtitle_font_size_unit_responsive . 'px;' : '';
			}
			if ( isset( $settings->subtitle_line_height_unit_responsive ) ) {
				echo ( '' !== $settings->subtitle_line_height_unit_responsive ) ? 'line-height:' . $settings->subtitle_line_height_unit_responsive . 'em;' : '';
			}
			?>
		}
	}
<?php } ?>
