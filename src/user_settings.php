<?php

require_once "include/utils.php";

if (! isset($_SESSION["user"])) {
    redirect("login.php");
}

function updateTheme($theme_name) {

}

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
                            changeTheme(this.options[this.selectedIndex].value);
                            selectThemeOption(this.options[this.selectedIndex].value)
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
                                            document.getElementById('create_theme').innerHTML = 'Update Theme';

                                            let chosen_theme = document.getElementById("chosen_theme");
                                            chosen_theme.value = '<?=$theme["theme_name"]?>';
                                        ">
                                        <?=$theme["theme_name"]?>
                                    </button>
                                </h3>
                                <div id="collapse_<?=$theme["theme_name"]?>" class="accordion-collapse collapse" data-bs-parent="#themesAccordion">
                                    <div class="accordion-body">
                                        <h4 class="mb-3" id="body_help_<?=$theme["theme_name"]?>">Body</h4>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <label for="body_color_<?=$theme["theme_name"]?>" class="form-label">Body Content Colour:</label>
                                                <input
                                                    type="color" class="form-control form-control-color"
                                                    id="body_color_<?=$theme["theme_name"]?>" name="body_color_<?=$theme["theme_name"]?>"
                                                    aria-describedby="body_help_<?=$theme["theme_name"]?>"
                                                    value="<?=clean_hex_color($theme["body_color"])?>"
                                                >
                                            </li>
                                            <li class="list-group-item">
                                                <label for="body_bg_<?=$theme["theme_name"]?>" class="form-label">Body Background Colour:</label>
                                                <input
                                                    type="color" class="form-control form-control-color"
                                                    id="body_bg_<?=$theme["theme_name"]?>" name="body_bg_<?=$theme["theme_name"]?>"
                                                    aria-describedby="body_help_<?=$theme["theme_name"]?>"
                                                    value="<?=clean_hex_color($theme["body_bg"])?>"
                                                >
                                            </li>
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
                                        document.getElementById('create_theme').innerHTML = 'Create Theme';
                                    ">
                                    Create New Theme
                                </button>
                            </h3>
                            <div id="collapseCreateTheme" class="accordion-collapse collapse" data-bs-parent="#themesAccordion">
                                <div class="accordion-body">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <input type="hidden" id="chosen_theme" name="chosen_theme">
                    <button type="submit" href="#" class="btn btn-success" id="update_theme" name="update_theme">Update Theme</button>
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