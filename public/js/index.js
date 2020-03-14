// Align form on middle and slightly higher
(function setContentHeight() {
    const content = document.getElementById('content');
    const loginForm = document.querySelector('#login form');
    const windowInnerHeight = window.innerHeight;
    const curWindowHeight = parseInt(windowInnerHeight);

    content.setAttribute('style', 'min-height: ' + (curWindowHeight - 56) + 'px');

    // Test if current page is the login page
    if (loginForm) {
        let loginMarginTop;

        // Set margin top of form base on current window height
        if (curWindowHeight <= 400) {
            loginMarginTop = (curWindowHeight / 2) * 0.07;
        } else {
            loginMarginTop = (curWindowHeight / 2) * 0.22;
        }
                
        loginForm.setAttribute('style', 'margin-top: ' + loginMarginTop + 'px');
    }

})();
