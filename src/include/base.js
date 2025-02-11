function setTheme(theme) {
    document.body.setAttribute("data-bs-theme", theme);
}

const isDarkMode = () =>
    window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches;

theme = localStorage.getItem("theme");
if (theme) {
    setTheme(theme);
} else {
    if (isDarkMode()) {
        setTheme("dark");
    } else {
        setTheme("light");
    }
}