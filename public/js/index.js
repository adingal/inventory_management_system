// Set content height depending on current viewport
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
        
        // Convert to string for concatenation
        loginMarginTop = loginMarginTop.toString();
        
        loginForm.setAttribute('style', 'margin-top: ' + loginMarginTop + 'px');
    }

})();

// Set href for edit button on items index page depending on selected id
(function setItemsEditBtn() {
    const selectedItem = document.getElementById('selected_item');
    const actionsEditBtn = document.querySelector('#actions a[href*="edit.php"]');
    
    if (actionsEditBtn) {
        selectedItem.addEventListener('click', handleChange);
    
        function handleChange() {
            handleHref();
            // Get currently selected id
            const selectedID = selectedItem.options[selectedItem.selectedIndex].value;
            // Set new href on edit button
            const newHref = actionsEditBtn.href + '?id=' + selectedID;
            actionsEditBtn.setAttribute('href', newHref);
        }
    
        function handleHref() {
            const curHref = actionsEditBtn.href;
            // Find .php on href
            const findPhp = curHref.indexOf('.php');
            // Set new href on edit button
            const newHref = curHref.substr(0, findPhp + 4);
            actionsEditBtn.setAttribute('href', newHref);
        }
    }
})();