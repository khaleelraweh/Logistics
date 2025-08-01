// Check saved theme on load
window.onload = () => {
const dark_theme_icon = document.getElementById('dark_theme_icon');
const light_theme_icon = document.getElementById('light_theme_icon');

const theme = sessionStorage.getItem("theme");
if (theme === 'dark') {
    document.body.classList.add('dark-theme');

    document.getElementById('bootstrap-style-auth').setAttribute('href','/admin/assets/css/bootstrap-dark.min.css')
    document.getElementById('app-style-auth').setAttribute('href','/admin/assets/css/app-dark.min.css')

    dark_theme_icon.classList.add('hide_item');
    dark_theme_icon.classList.remove('show_item');

    light_theme_icon.classList.add('show_item');
    light_theme_icon.classList.remove('hide_item');
}else{
    document.getElementById('bootstrap-style-auth').setAttribute('href','/admin/assets/css/bootstrap.min.css')
    document.getElementById('app-style-auth').setAttribute('href','/admin/assets/css/app-dark.min.css')
}


};

// Toggle function
function toggleTheme() {
    const isDark = document.body.classList.toggle('dark-theme');

    if(isDark){
        dark_theme_icon.classList.add('hide_item');
        dark_theme_icon.classList.remove('show_item');

        light_theme_icon.classList.add('show_item');
        light_theme_icon.classList.remove('hide_item');

        document.getElementById('bootstrap-style-auth').setAttribute('href','/admin/assets/css/bootstrap-dark.min.css')
        document.getElementById('app-style-auth').setAttribute('href','/admin/assets/css/app-dark.min.css')

    }else{
        dark_theme_icon.classList.add('show_item');
        dark_theme_icon.classList.remove('hide_item');

        light_theme_icon.classList.add('hide_item');
        light_theme_icon.classList.remove('show_item');

        document.getElementById('bootstrap-style-auth').setAttribute('href','/admin/assets/css/bootstrap.min.css')
        document.getElementById('app-style-auth').setAttribute('href','/admin/assets/css/app.min.css')

    }

    sessionStorage.setItem("theme", isDark ? "dark" : "light")
}

