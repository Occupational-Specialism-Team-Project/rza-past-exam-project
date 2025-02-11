function changeTheme(new_theme) {
    if (new_theme) { // If the user changes the theme
        if (new_theme == "system") {
            localStorage.removeItem("theme");
        } else {
            localStorage.setItem("theme", new_theme);
        }
    }

    updateTheme();
}

function selectThemeOption(theme) {
    if (theme) {
        if (theme != "dark" && theme != "light" && theme != "high_contrast") {
            let theme_form_option = document.querySelector("#collapse_" + theme);
            let chosen_theme = document.getElementById("chosen_theme");
            if (theme_form_option && chosen_theme) {
                let theme_form_collapse = new bootstrap.Collapse(theme_form_option);
                theme_form_collapse.show();

                chosen_theme.value = theme;
            }
        }
    }
}

theme = localStorage.getItem("theme");
selectThemeOption(theme);