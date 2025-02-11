<?php

require_once "include/utils.php";

if (! isset($_SESSION["user"])) {
    redirect("login.php");
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
        <div class="col-md-4 mx-auto mb-5">
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
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse_<?=$theme["theme_name"]?>" aria-expanded="false"
                                        aria-controls="collapse_<?=$theme["theme_name"]?>" onclick="
                                            document.getElementById('create_theme').innerHTML = 'Update Theme';
                                        ">
                                        <?=$theme["theme_name"]?>
                                    </button>
                                </h2>
                                <div id="collapse_<?=$theme["theme_name"]?>" class="accordion-collapse collapse" data-bs-parent="#themesAccordion">
                                    <form action="" method="POST" class="accordion-body">
                                    </form>
                                </div>
                            </div>
                        <?php endforeach ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseCreateTheme" aria-expanded="false"
                                    aria-controls="collapseCreateTheme" onclick="
                                        document.getElementById('create_theme').innerHTML = 'Create Theme';
                                    ">
                                    Create New Theme
                                </button>
                            </h2>
                            <div id="collapseCreateTheme" class="accordion-collapse collapse" data-bs-parent="#themesAccordion">
                                <form action="" method="POST" class="accordion-body">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" href="#" class="btn btn-success" id="create_theme" name="create_theme">Update Theme</a>
                </div>
            </section>
        </div>
    </div>
</article>

<?php include_once "include/footer.php";