
// performace improvements
window.addEventListener('layout-updated', event => {
    const prefs = event.detail;
    const html = document.getElementById('html-root');
    const body = document.body;

    body.classList.add('transition');

    if (prefs.rtl) {
        html?.setAttribute('dir', 'rtl');
        html?.setAttribute('lang', 'ar');
    } else {
        html?.setAttribute('dir', 'ltr');
        html?.setAttribute('lang', 'en');
    }

    body.setAttribute('dir', prefs.rtl ? 'rtl' : 'ltr');

    body.setAttribute('data-layout', prefs.layout ?? 'vertical');
    body.setAttribute('data-topbar', prefs.topbar ?? 'dark');
    body.setAttribute('data-sidebar', prefs.sidebar ?? 'dark');
    body.setAttribute('data-sidebar-size', prefs.sidebar_size ?? 'default');
    body.setAttribute('data-layout-size', prefs.layout_size ?? 'fluid');

    body.classList.toggle('preloader', !!prefs.preloader);
    body.classList.toggle('vertical-collpsed', prefs.layout === 'vertical' && prefs.sidebar_size === 'icon');

    const bootstrapLink = document.getElementById('bootstrap-style');
    const appLink = document.getElementById('app-style');

    if (prefs.rtl) {
        bootstrapLink?.setAttribute('href', prefs.mode === 'dark'
            ? '/admin/assets/css/bootstrap-dark-rtl.min.css'
            : '/admin/assets/css/bootstrap-rtl.min.css');

        appLink?.setAttribute('href', prefs.mode === 'dark'
            ? '/admin/assets/css/app-dark-rtl.min.css'
            : '/admin/assets/css/app-rtl.min.css');
    } else {
        bootstrapLink?.setAttribute('href', prefs.mode === 'dark'
            ? '/admin/assets/css/bootstrap-dark.min.css'
            : '/admin/assets/css/bootstrap.min.css');

        appLink?.setAttribute('href', prefs.mode === 'dark'
            ? '/admin/assets/css/app-dark.min.css'
            : '/admin/assets/css/app.min.css');
    }


    const verticalMenu = document.getElementById('vertical-menu');
    const horizontalMenu = document.getElementById('horizontal-menu');
    if (verticalMenu && horizontalMenu) {
        if (prefs.layout === 'horizontal') {
            verticalMenu.style.display = 'none';
            horizontalMenu.style.display = 'block';
        } else {
            verticalMenu.style.display = 'block';
            horizontalMenu.style.display = 'none';
        }
    }

    // handle preloader
    const preloader = document.getElementById('preloader');
    if (preloader) {
        if (prefs.preloader) {
            preloader.style.display = 'block';
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 1000);
        } else {
            preloader.style.display = 'none';
        }
    }

    //Handle right-bar change item status when change happen in layout-customizer
    const mode = event.detail.mode;
    const rtl = event.detail.rtl;

    // Mode sync
    document.getElementById('light-mode-switch').checked = (mode === 'light');
    document.getElementById('dark-mode-switch').checked = (mode === 'dark');

    // RTL sync
    document.getElementById('rtl-mode-switch').checked = rtl === true || rtl === 'true';

});


// Handle preloader visibility on page load
window.addEventListener('load', () => {
    const preloader = document.getElementById('preloader');

    if (preloader) {
        setTimeout(() => {
            preloader.style.display = 'none';
        }, 500);
    }
});


// Handle sidebar toggle
document.addEventListener('DOMContentLoaded', () => {
    const lightSwitch = document.getElementById('light-mode-switch');
    const darkSwitch = document.getElementById('dark-mode-switch');
    const rtlSwitch = document.getElementById('rtl-mode-switch');

    const prefs = window.currentLayoutPrefs || {};

    // Sync initial state
    if (lightSwitch) lightSwitch.checked = (prefs.mode ?? 'light') === 'light';
    if (darkSwitch) darkSwitch.checked = (prefs.mode ?? 'light') === 'dark';
    if (rtlSwitch) rtlSwitch.checked = !!prefs.rtl;

    function updateLayoutPrefs(newPrefs) {
        const updatedPrefs = { ...window.currentLayoutPrefs, ...newPrefs };
        window.currentLayoutPrefs = updatedPrefs;

        const event = new CustomEvent('layout-updated', { detail: updatedPrefs });
        window.dispatchEvent(event);

        // Save to backend
        saveLayoutPrefs(updatedPrefs);
    }

    function saveLayoutPrefs(prefs) {
        fetch(window.layoutPrefsSaveUrl, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": window.csrfToken,
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ layout_preferences: prefs })
        })
        .then(res => res.json())
        .then(() => console.log("Preferences saved"))
        .catch(err => console.error("Failed to save layout prefs", err));
    }

    // Light mode
    if (lightSwitch) {
        lightSwitch.addEventListener('change', () => {
            if (lightSwitch.checked) {
                darkSwitch.checked = false;
                updateLayoutPrefs({ mode: 'light' });
            }
        });
    }

    // Dark mode
    if (darkSwitch) {
        darkSwitch.addEventListener('change', () => {
            if (darkSwitch.checked) {
                lightSwitch.checked = false;
                updateLayoutPrefs({ mode: 'dark' });
            }
        });
    }

    // RTL mode
    if (rtlSwitch) {
        rtlSwitch.addEventListener('change', () => {
            updateLayoutPrefs({ rtl: rtlSwitch.checked });
        });
    }
});

// Custom alert message

// لتنسيق رسالة التنبيهات القادمة مع الراوت
// رسالة التنبيهات موجودة في الملف
// views/partial/admin/alert.blade.php
// هذا الكود يقوم باستدعاء الاليرت ثم اعمل لها فيد تو بعد خمس ثواني
// واعمل لها سلايد اب بسرعة نص ثانية
$(function(){
    $("#alert-message").fadeTo(5000,500).slideUp(500,function(){
        $("#alert-message").slideUp(500);
    })
});

// general confirm delete message
//Confirm Delete Function
function confirmDelete(deleteElementId, confirmMessage, confirmButtonText = "Yes", cancelButtonText = "Cancel") {
    Swal.fire({
        title: confirmMessage || 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: confirmButtonText,
        cancelButtonText: cancelButtonText,
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(deleteElementId).submit();
        }
    });
}


