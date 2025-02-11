theme = localStorage.getItem("theme");
if (theme) {
    document.getElementById("theme");
    setTheme(theme);
} else {
    if (isDarkMode()) {
        setTheme("dark");
    } else {
        setTheme("light");
    }
}

localStorage.setItem("theme", "dark");