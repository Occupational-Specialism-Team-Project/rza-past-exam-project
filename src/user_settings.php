<?php

require_once "include/utils.php";

if (! isset($_SESSION["user"])) {
    redirect("login.php");
}

function updateTheme($theme_name) {

}

function create_color_input($theme_name, $setting, $setting_formal, $setting_value, $group) {
    include "include/color_input.php";
}

?>


<?php

const PAGE_TITLE = "User Settings";
include_once "include/base.php";

?>

<article class="container-fluid">
    <div class="row">
        <h1 class="mx-auto text-center my-5"><?=PAGE_TITLE?></h1>
    </div>
    <div class="row">
        <div class="col-md-4 mx-auto mb-5">
            <section id="chooseTheme" class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fa-solid fa-palette"></i> Choose Theme
                    </h2>
                </div>
                <div class="card-body">
                    <select id="selectTheme" class="form-select" aria-label="Select a Theme"
                        onchange="
                            selectThemeOption(this.options[this.selectedIndex].value)
                            changeTheme(this.options[this.selectedIndex].value);
                        ">
                        <option id="system" value="system">System</option>
                        <option id="light" value="light">Light</option>
                        <option id="dark" value="dark">Dark</option>
                        <option id="high_contrast" value="high_contrast">High Contrast</option>
                        <?php foreach ($themes->result as $theme): ?>
                            <option id="<?=$theme["theme_name"]?>" value="<?=$theme["theme_name"]?>"><?=$theme["theme_name"]?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <form action="" method="POST" class="col-md-4 mx-auto mb-5">
            <section id="createOrEditTheme" class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fa-solid fa-paintbrush"></i> Create/Edit Theme
                    </h2>
                </div>
                <div class="card-body">
                    <div class="accordion" id="themesAccordion">
                        <?php foreach ($themes->result as $theme): ?>
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse_<?=$theme["theme_name"]?>" aria-expanded="false"
                                        aria-controls="collapse_<?=$theme["theme_name"]?>" onclick="
                                            selectTheme('<?=$theme['theme_name']?>')
                                        ">
                                        <?=$theme["theme_name"]?>
                                    </button>
                                </h3>
                                <div id="collapse_<?=$theme["theme_name"]?>" class="accordion-collapse collapse" data-bs-parent="#themesAccordion">
                                    <div class="accordion-body">
                                        <?php $theme_name = $theme["theme_name"] ?>

                                        <?php $group = "body" ?>
                                        <h4 class="mb-3" id="<?=$group?>_help_<?=$theme_name?>">Body</h4>
                                        <ul class="list-group mb-3">
                                            <?php
                                                create_color_input(
                                                    $theme_name,
                                                    "body_color",
                                                    "Body Content Colour",
                                                    $theme["body_color"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "body_bg",
                                                    "Body Background Colour",
                                                    $theme["body_bg"],
                                                    $group
                                                );
                                            ?>
                                        </ul>

                                        <?php $group = "secondary" ?>
                                        <h4 class="mb-3" id="<?=$group?>_help_<?=$theme_name?>">Secondary</h4>
                                        <ul class="list-group mb-3">
                                            <?php
                                                create_color_input(
                                                    $theme_name,
                                                    "secondary",
                                                    "Secondary Colour",
                                                    $theme["secondary"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "secondary_color",
                                                    "Secondary Content Colour",
                                                    $theme["secondary_color"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "secondary_bg",
                                                    "Secondary Background Colour",
                                                    $theme["secondary_bg"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "secondary_bg_subtle",
                                                    "Secondary Background Colour (Subtle)",
                                                    $theme["secondary_bg_subtle"],
                                                    $group
                                                );
                                            ?>
                                        </ul>

                                        <?php $group = "tertiary" ?>
                                        <h4 class="mb-3" id="<?=$group?>_help_<?=$theme_name?>">Tertiary</h4>
                                        <ul class="list-group mb-3">
                                            <?php
                                                create_color_input(
                                                    $theme_name,
                                                    "tertiary_color",
                                                    "Tertiary Content Colour",
                                                    $theme["tertiary_color"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "tertiary_bg",
                                                    "Tertiary Background Colour",
                                                    $theme["tertiary_bg"],
                                                    $group
                                                );
                                            ?>
                                        </ul>

                                        <?php $group = "emphasis" ?>
                                        <h4 class="mb-3" id="<?=$group?>_help_<?=$theme_name?>">Emphasis</h4>
                                        <ul class="list-group mb-3">
                                            <?php
                                                create_color_input(
                                                    $theme_name,
                                                    "emphasis_color",
                                                    "Emphasis Content Colour",
                                                    $theme["emphasis_color"],
                                                    $group
                                                );
                                            ?>
                                        </ul>

                                        <?php $group = "border" ?>
                                        <h4 class="mb-3" id="<?=$group?>_help_<?=$theme_name?>">Border</h4>
                                        <ul class="list-group mb-3">
                                            <?php
                                                create_color_input(
                                                    $theme_name,
                                                    "border_color",
                                                    "Border Colour",
                                                    $theme["border_color"],
                                                    $group
                                                );
                                            ?>
                                        </ul>

                                        <?php $group = "primary" ?>
                                        <h4 class="mb-3" id="<?=$group?>_help_<?=$theme_name?>">Primary</h4>
                                        <ul class="list-group mb-3">
                                            <?php
                                                create_color_input(
                                                    $theme_name,
                                                    "primary_color",
                                                    "Primary Colour",
                                                    $theme["primary_color"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "primary_bg_subtle",
                                                    "Primary Background Colour (Subtle)",
                                                    $theme["primary_bg_subtle"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "primary_border_subtle",
                                                    "Primary Border Colour (Subtle)",
                                                    $theme["primary_border_subtle"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "primary_text_emphasis",
                                                    "Primary Text Colour (Emphasis)",
                                                    $theme["primary_text_emphasis"],
                                                    $group
                                                );
                                            ?>
                                        </ul>

                                        <?php $group = "success" ?>
                                        <h4 class="mb-3" id="<?=$group?>_help_<?=$theme_name?>">Success</h4>
                                        <ul class="list-group mb-3">
                                            <?php
                                                create_color_input(
                                                    $theme_name,
                                                    "success",
                                                    "Success Colour",
                                                    $theme["success"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "success_bg_subtle",
                                                    "Success Background Colour (Subtle)",
                                                    $theme["success_bg_subtle"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "success_border_subtle",
                                                    "Success Border Colour (Subtle)",
                                                    $theme["success_border_subtle"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "success_text_emphasis",
                                                    "Success Text Colour (Emphasis)",
                                                    $theme["success_text_emphasis"],
                                                    $group
                                                );
                                            ?>
                                        </ul>

                                        <?php $group = "danger" ?>
                                        <h4 class="mb-3" id="<?=$group?>_help_<?=$theme_name?>">Danger</h4>
                                        <ul class="list-group mb-3">
                                            <?php
                                                create_color_input(
                                                    $theme_name,
                                                    "danger",
                                                    "Danger Colour",
                                                    $theme["danger"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "danger_bg_subtle",
                                                    "Danger Background Colour (Subtle)",
                                                    $theme["danger_bg_subtle"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "danger_border_subtle",
                                                    "Danger Border Colour (Subtle)",
                                                    $theme["danger_border_subtle"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "danger_text_emphasis",
                                                    "Danger Text Colour (Emphasis)",
                                                    $theme["danger_text_emphasis"],
                                                    $group
                                                );
                                            ?>
                                        </ul>

                                        <?php $group = "warning" ?>
                                        <h4 class="mb-3" id="<?=$group?>_help_<?=$theme_name?>">Warning</h4>
                                        <ul class="list-group mb-3">
                                            <?php
                                                create_color_input(
                                                    $theme_name,
                                                    "warning",
                                                    "Warning Colour",
                                                    $theme["warning"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "warning_bg_subtle",
                                                    "Warning Background Colour (Subtle)",
                                                    $theme["warning_bg_subtle"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "warning_border_subtle",
                                                    "Warning Border Colour (Subtle)",
                                                    $theme["warning_border_subtle"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "warning_text_emphasis",
                                                    "Warning Text Colour (Emphasis)",
                                                    $theme["warning_text_emphasis"],
                                                    $group
                                                );
                                            ?>
                                        </ul>

                                        <?php $group = "info" ?>
                                        <h4 class="mb-3" id="<?=$group?>_help_<?=$theme_name?>">Info</h4>
                                        <ul class="list-group mb-3">
                                            <?php
                                                create_color_input(
                                                    $theme_name,
                                                    "info",
                                                    "Info Colour",
                                                    $theme["info"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "info_bg_subtle",
                                                    "Info Background Colour (Subtle)",
                                                    $theme["info_bg_subtle"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "info_border_subtle",
                                                    "Info Border Colour (Subtle)",
                                                    $theme["info_border_subtle"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "info_text_emphasis",
                                                    "Info Text Colour (Emphasis)",
                                                    $theme["info_text_emphasis"],
                                                    $group
                                                );
                                            ?>
                                        </ul>

                                        <?php $group = "light" ?>
                                        <h4 class="mb-3" id="<?=$group?>_help_<?=$theme_name?>">Light</h4>
                                        <ul class="list-group mb-3">
                                            <?php
                                                create_color_input(
                                                    $theme_name,
                                                    "light",
                                                    "Light Colour",
                                                    $theme["light"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "light_bg_subtle",
                                                    "Light Background Colour (Subtle)",
                                                    $theme["light_bg_subtle"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "light_border_subtle",
                                                    "Light Border Colour (Subtle)",
                                                    $theme["light_border_subtle"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "light_text_emphasis",
                                                    "Light Text Colour (Emphasis)",
                                                    $theme["light_text_emphasis"],
                                                    $group
                                                );
                                            ?>
                                        </ul>

                                        <?php $group = "dark" ?>
                                        <h4 class="mb-3" id="<?=$group?>_help_<?=$theme_name?>">Dark</h4>
                                        <ul class="list-group mb-3">
                                            <?php
                                                create_color_input(
                                                    $theme_name,
                                                    "dark",
                                                    "Dark Colour",
                                                    $theme["dark"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "dark_bg_subtle",
                                                    "Dark Background Colour (Subtle)",
                                                    $theme["dark_bg_subtle"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "dark_border_subtle",
                                                    "Dark Border Colour (Subtle)",
                                                    $theme["dark_border_subtle"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "dark_text_emphasis",
                                                    "Dark Text Colour (Emphasis)",
                                                    $theme["dark_text_emphasis"],
                                                    $group
                                                );
                                            ?>
                                        </ul>

                                        <?php $group = "forms" ?>
                                        <h4 class="mb-3" id="<?=$group?>_help_<?=$theme_name?>">Forms</h4>
                                        <ul class="list-group mb-3">
                                            <?php
                                                create_color_input(
                                                    $theme_name,
                                                    "form_valid_color",
                                                    "Form Valid Colour",
                                                    $theme["form_valid_color"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "form_valid_border_color",
                                                    "Form Valid Border Colour",
                                                    $theme["form_valid_border_color"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "form_invalid_color",
                                                    "Form Invalid Colour",
                                                    $theme["form_invalid_color"],
                                                    $group
                                                );
                                                create_color_input(
                                                    $theme_name,
                                                    "form_invalid_border_color",
                                                    "Form Invalid Border Colour",
                                                    $theme["form_invalid_border_color"],
                                                    $group
                                                );
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseCreateTheme" aria-expanded="false"
                                    aria-controls="collapseCreateTheme" onclick="
                                        selectTheme()
                                    ">
                                    Create New Theme
                                </button>
                            </h3>
                            <div id="collapseCreateTheme" class="accordion-collapse collapse" data-bs-parent="#themesAccordion">
                                <div class="accordion-body">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="themeCrud" class="card-footer d-none">
                    <input type="hidden" id="chosen_theme" name="chosen_theme">
                    <button type="submit" href="#" class="btn btn-success" id="update_theme" name="update_theme">Update Theme</button>
                    <a id="delete_theme" href="user_settings.php"><button type="button" class="btn btn-danger">Delete Theme</button></a>
                    <?php
                        if (isset($_POST["update_theme"])) {
                            var_dump($_POST["chosen_theme"]);
                            var_dump($_POST["body_color_".$_POST["chosen_theme"]]);
                            var_dump($_POST["body_bg_".$_POST["chosen_theme"]]);
                        }
                    ?>
                </div>
            </section>
        </form>
    </div>
</article>

<?php include_once "include/footer.php";