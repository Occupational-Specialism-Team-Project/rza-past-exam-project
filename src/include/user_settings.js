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
        let oldTheme = localStorage.getItem("theme");
        let hardcodedThemes = ["dark", "light", "high_contrast", "system"];
        if (hardcodedThemes.includes(theme)) { // Hide old theme
            let theme_form_option = document.querySelector("#collapse_" + oldTheme);
            if (theme_form_option) {
                let theme_form_collapse = bootstrap.Collapse.getOrCreateInstance(theme_form_option);
                theme_form_collapse.hide();
            }
        } else { // Show new theme
            let theme_form_option = document.querySelector("#collapse_" + theme);
            if (theme_form_option) {
                let theme_form_collapse = bootstrap.Collapse.getOrCreateInstance(theme_form_option);
                theme_form_collapse.show();
            }
        }
    }
}

function selectTheme(theme) {
    let chosenTheme = document.getElementById("chosen_theme");
    let deleteTheme = document.getElementById("delete_theme");
    let updateTheme = document.getElementById("update_theme");
    let themeCrud = document.getElementById("themeCrud");

    let submitButtonText = "";
    let deleteQueryString = "";
    chosenTheme.value = "";
    if (theme == "Create New Theme") {
        themeCrud.classList.remove("d-none");
        deleteTheme.classList.add("d-none");

        submitButtonText = "Create Theme";
    } else if (theme) {
        themeCrud.classList.remove("d-none");
        deleteTheme.classList.remove("d-none");

        submitButtonText = "Update Theme";

        deleteQueryString = "?delete_theme=" + theme;
        chosenTheme.value = theme;
    } else { // Deselects the theme
        chosenTheme.value = "";
        themeCrud.classList.add("d-none");
    }
    deleteTheme.setAttribute("href", "user_settings.php" + deleteQueryString);
    updateTheme.innerHTML = submitButtonText;
}

theme = localStorage.getItem("theme");
selectThemeOption(theme);
const allAccordionItems = document.querySelectorAll(".accordion-item");
allAccordionItems.forEach(accordionItem => {
    accordionItem.addEventListener('shown.bs.collapse', event => {
        let accordionItemShown = event.currentTarget;
        let themeButton = accordionItemShown.querySelector(".accordion-button");
        if (themeButton) {
            let themeName = themeButton.innerHTML.trim();
            selectTheme(themeName);
        }
    });
    accordionItem.addEventListener('hidden.bs.collapse', event => {
        let accordionItemHidden = event.currentTarget;
        let themeButton = accordionItemHidden.querySelector(".accordion-button");
        if (themeButton) {
            let allCollapsed = true;
            allAccordionItems.forEach(accordionItem => {
                let themeButton = accordionItem.querySelector(".accordion-button");
                if (themeButton) {
                    if (!(themeButton.classList.contains("collapsed"))) {
                        allCollapsed = false;
                    }
                }
            })
            if (allCollapsed) {
                selectTheme();
            }
        }
    });
});