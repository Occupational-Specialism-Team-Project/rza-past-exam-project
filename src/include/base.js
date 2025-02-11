const isDarkMode = () =>
    window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches;

const setTheme = (theme) =>
    document.body.setAttribute("data-bs-theme", theme);

function updateTheme() {
    current_theme = localStorage.getItem("theme");
    if (current_theme) { // If the user has already set a theme, this will execute without changing the theme.
        setTheme(current_theme);
    } else {
        if (isDarkMode()) {
            setTheme("dark");
        } else {
            setTheme("light");
        }
    }

    choose_theme_select = document.getElementById("selectTheme");
    selected_theme_option = document.getElementById(current_theme);
    if (selected_theme_option) {
        choose_theme_select.value = selected_theme_option.value
    }
}

updateTheme();