// Global elements object
const el = {
    selectedId: document.getElementById('selected_id'),
    actionsViewBtn: document.querySelector('#actions a[href*="view.php"]'),
    content: document.getElementById('content'),
    loginForm: document.querySelector('#login form')
};

// Set content height depending on current viewport
(function setContentHeight() {
    const windowInnerHeight = window.innerHeight;
    const curWindowHeight = parseInt(windowInnerHeight);

    el.content.setAttribute('style', 'min-height: ' + (curWindowHeight - 56) + 'px');

    // If login form is present
    if (el.loginForm) {
        let loginMarginTop;

        // Set margin top of form base on current window height
        if (curWindowHeight <= 400) {
            loginMarginTop = (curWindowHeight / 2) * 0.07;
        } else {
            loginMarginTop = (curWindowHeight / 2) * 0.22;
        }
        
        // Convert to string for concatenation
        loginMarginTop = loginMarginTop.toString();
        el.loginForm.setAttribute('style', 'margin-top: ' + loginMarginTop + 'px');
    }

})();

// Set href for edit button on items index page depending on selected id
(function setItemsViewBtn() {
    let currentId = el.selectedId.options[el.selectedId.selectedIndex].value;

    // If actions view button is present
    if (el.actionsViewBtn) {
        setViewBtnDefaultId();
        el.selectedId.addEventListener('click', handleChange);

        // Set default id on views edit button
        function setViewBtnDefaultId() {
            handleHref();
            const newHref = el.actionsViewBtn.href + '?id=' + currentId;
            el.actionsViewBtn.setAttribute('href', newHref);            
        }

        // Set the currently selected id
        function handleChange() {
            handleHref();
            // Get currently selected id
            currentId = el.selectedId.options[el.selectedId.selectedIndex].value;
            // Set new href on edit button
            const newHref = el.actionsViewBtn.href + '?id=' + currentId;
            el.actionsViewBtn.setAttribute('href', newHref);
        }
        
        // Remove trailing id parameters
        function handleHref() {
            const curHref = el.actionsViewBtn.href;
            // Find .php on href
            const findPhp = curHref.indexOf('.php');
            // Set new href on edit button
            const newHref = curHref.substr(0, findPhp + 4);
            el.actionsViewBtn.setAttribute('href', newHref);
        }
    }
})();