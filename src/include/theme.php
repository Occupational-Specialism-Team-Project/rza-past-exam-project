[data-bs-theme="<?=$theme["theme_name"]?>"] {
    /* Body — Default foreground (color) and background, including components.	 */
    --bs-body-color: <?=$theme["body_color"]?>;
    --bs-body-color-rgb: <?=hex_to_rgb($theme["body_color"])?>;
    --bs-body-bg: <?=$theme["body_bg"]?>;
    --bs-body-bg-rgb: <?=hex_to_rgb($theme["body_bg"])?>;

    /* Secondary — Use the color option for lighter text. Use the bg option for dividers and to indicate disabled component states.	 */
    --bs-secondary: <?=$theme["secondary"]?>;
    --bs-secondary-color: <?=$theme["secondary_color"]?>;
    --bs-secondary-color-rgb: <?=hex_to_rgb($theme["secondary_color"])?>;
    --bs-secondary-bg: <?=$theme["secondary_bg"]?>;
    --bs-secondary-bg-subtle: <?=$theme["secondary_bg_subtle"]?>;
    --bs-secondary-bg-rgb: <?=hex_to_rgb($theme["secondary_bg"])?>;

    /* Tertiary — Use the color option for even lighter text. Use the bg option to style backgrounds for hover states, accents, and wells.	 */
    --bs-tertiary-color: <?=$theme["tertiary_color"]?>;
    --bs-tertiary-color-rgb: <?=hex_to_rgb($theme["tertiary_color"])?>;
    --bs-tertiary-bg: <?=$theme["tertiary_bg"]?>;
    --bs-tertiary-bg-rgb: <?=hex_to_rgb($theme["tertiary_bg"])?>;

    /* Emphasis — For higher contrast text. Not applicable for backgrounds.	 */
    --bs-emphasis-color: <?=$theme["emphasis_color"]?>;
    --bs-emphasis-color-rgb: <?=hex_to_rgb($theme["emphasis_color"])?>;

    /* Border — For component borders, dividers, and rules. Use --bs-border-color-translucent to blend with backgrounds with an rgba() value.	 */
    --bs-border-color: <?=$theme["border_color"]?>;
    --bs-border-color-rgb: <?=hex_to_rgb($theme["border_color"])?>;

    /* Primary — Main theme color, used for hyperlinks, focus styles, and component and form active states.	 */
    --bs-primary: <?=$theme["primary_color"]?>;
    --bs-primary-rgb: <?=hex_to_rgb($theme["primary_color"])?>;
    --bs-primary-bg-subtle: <?=$theme["primary_bg_subtle"]?>;
    --bs-primary-border-subtle: <?=$theme["primary_border_subtle"]?>;
    --bs-primary-text-emphasis: <?=$theme["primary_text_emphasis"]?>;

    /* Success — Theme color used for positive or successful actions and information.	 */
    --bs-success: <?=$theme["success"]?>;
    --bs-success-rgb: <?=hex_to_rgb($theme["success"])?>;
    --bs-success-bg-subtle: <?=$theme["success_bg_subtle"]?>;
    --bs-success-border-subtle: <?=$theme["success_border_subtle"]?>;
    --bs-success-text-emphasis: <?=$theme["success_text_emphasis"]?>;

    /* Danger — Theme color used for errors and dangerous actions.	 */
    --bs-danger: <?=$theme["danger"]?>;
    --bs-danger-rgb: <?=hex_to_rgb($theme["danger"])?>;
    --bs-danger-bg-subtle: <?=$theme["danger_bg_subtle"]?>;
    --bs-danger-border-subtle: <?=$theme["danger_border_subtle"]?>;
    --bs-danger-text-emphasis: <?=$theme["danger_text_emphasis"]?>;

    /* Warning — Theme color used for non-destructive warning messages.	 */
    --bs-warning: <?=$theme["warning"]?>;
    --bs-warning-rgb: <?=hex_to_rgb($theme["warning"])?>;
    --bs-warning-bg-subtle: <?=$theme["warning_bg_subtle"]?>;
    --bs-warning-border-subtle: <?=$theme["warning_border_subtle"]?>;
    --bs-warning-text-emphasis: <?=$theme["warning_text_emphasis"]?>;
    
    /* Info — Theme color used for neutral and informative content.	 */
    --bs-info: <?=$theme["info"]?>;
    --bs-info-rgb: <?=hex_to_rgb($theme["info"])?>;
    --bs-info-bg-subtle: <?=$theme["info_bg_subtle"]?>;
    --bs-info-border-subtle: <?=$theme["info_border_subtle"]?>;
    --bs-info-text-emphasis: <?=$theme["info_text_emphasis"]?>;

    /* Light — Additional theme option for less contrasting colors.	 */
    --bs-light: <?=$theme["light"]?>;
    --bs-light-rgb: <?=hex_to_rgb($theme["light"])?>;
    --bs-light-bg-subtle: <?=$theme["light_bg_subtle"]?>;
    --bs-light-border-subtle: <?=$theme["light_border_subtle"]?>;
    --bs-light-text-emphasis: <?=$theme["light_text_emphasis"]?>;

    /* Dark — Additional theme option for higher contrasting colors.	 */
    --bs-dark: <?=$theme["dark"]?>;
    --bs-dark-rgb: <?=hex_to_rgb($theme["dark"])?>;
    --bs-dark-bg-subtle: <?=$theme["dark_bg_subtle"]?>;
    --bs-dark-border-subtle: <?=$theme["dark_border_subtle"]?>;
    --bs-dark-text-emphasis: <?=$theme["dark_text_emphasis"]?>;

    /* Forms	 */
    --bs-form-valid-color: <?=$theme["form_valid_color"]?>;
    --bs-form-valid-border-color: <?=$theme["form_valid_border_color"]?>;
    --bs-form-invalid-color: <?=$theme["form_invalid_color"]?>;
    --bs-form-invalid-border-color: <?=$theme["form_invalid_border_color"]?>;

    /* RZA Colours	 */
    --rza-green: <?=$theme["rza_green"]?>;
    --rza-brown: <?=$theme["rza_brown"]?>;
    --rza-outline-gray: <?=$theme["rza_outline_gray"]?>;
}