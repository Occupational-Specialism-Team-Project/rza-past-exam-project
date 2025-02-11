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