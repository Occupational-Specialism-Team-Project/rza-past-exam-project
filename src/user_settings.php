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
            <section id="themeSettings" class="card">
                <div class="card-header">
                    <h2 class="card-title">Themes</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
                <div class="card-footer">
                    <button type="submit" href="#" class="btn btn-success" id="save_theme_settings" name="save_theme_settings">Go somewhere</a>
                </div>
            </section>
        </div>
        <section id="colourSettings" class="col-md-4">
            <h2>Colours</h2>
        </section>
    </div>
</article>

<?php include_once "include/footer.php";