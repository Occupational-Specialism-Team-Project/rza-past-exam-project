<?php

require_once "include/utils.php";

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
                        <i class="fa-solid fa-palette"></i> Choose Themes
                    </h2>
                </div>
                <div class="card-body">
                    <select id="selectTheme" class="form-select" aria-label="Select a Theme" onchange="changeTheme(this.options[this.selectedIndex].value)">
                        <option id="system" value="system">System</option>
                        <option id="light" value="light">Light</option>
                        <option id="dark" value="dark">Dark</option>
                        <option id="high_contrast" value="high_contrast">High Contrast</option>
                        <?php foreach ($themes->result as $theme): ?>
                            <option id="<?=$theme["theme_name"]?>" value="<?=$theme["theme_name"]?>">Test Theme</option>
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
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
                <div class="card-footer">
                    <button type="submit" href="#" class="btn btn-success" id="create_theme" name="create_theme">Go somewhere</a>
                </div>
            </section>
        </div>
    </div>
</article>

<?php include_once "include/footer.php";