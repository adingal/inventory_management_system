// Global elements object
const el = {
    selectedId: document.getElementById('selected_id'),
    actionsViewBtn: document.querySelector('#actions a[href*="view.php"]'),
    actionsWithdrawBtn: document.querySelector('#actions a[href*="withdraw.php"]'),
    actionsReplenishBtn: document.querySelector('#actions a[href*="replenish.php"]'),
    content: document.getElementById('content'),
    loginForm: document.querySelector('#login form')
};


/*
* HELPER FUNCTIONS
*/

// Remove trailing id parameters
function handleHref(element) {
    const curHref = element.href;
    // Find .php on href
    const findPhp = curHref.indexOf('.php');
    // Set new href on edit button
    const newHref = curHref.substr(0, findPhp + 4);
    element.setAttribute('href', newHref);
}

// Set the currently selected id
function handleChange(selectElement, targetElement) {
    handleHref(targetElement);
    // Get currently selected id
    currentId = selectElement.options[selectElement.selectedIndex].value;
    // Set new href on edit button
    const newHref = targetElement.href + '?id=' + currentId;
    targetElement.setAttribute('href', newHref);
}

// Set default id on links href
function setBtnDefaultId(element, currentId) {
    handleHref(element);
    const newHref = element.href + '?id=' + currentId;
    element.setAttribute('href', newHref);
}


/*
* IIFE's
*/

// Set href for edit button on items index page depending on selected id
(function setItemsViewBtn() {
    
    // If actions view button is present
    if (el.actionsViewBtn) {
        let currentId = el.selectedId.options[el.selectedId.selectedIndex].value;
        setBtnDefaultId(el.actionsViewBtn, currentId);

        el.selectedId.addEventListener('click', () => {
            handleChange(el.selectedId, el.actionsViewBtn);
        });
    }

})();

// Set href for withdraw button on items index page depending on selected id
(function setItemsWithdrawBtn() {
    
    // If actions withdraw button is present
    if (el.actionsWithdrawBtn) {
        let currentId = el.selectedId.options[el.selectedId.selectedIndex].value;
        setBtnDefaultId(el.actionsWithdrawBtn, currentId);

        el.selectedId.addEventListener('click', () => {
            handleChange(el.selectedId, el.actionsWithdrawBtn);
        });
    }

})();

// Set href for replenish button on items index page depending on selected id
(function setItemsReplenishBtn() {
    
    // If actions replenish button is present
    if (el.actionsReplenishBtn) {
        let currentId = el.selectedId.options[el.selectedId.selectedIndex].value;
        setBtnDefaultId(el.actionsReplenishBtn, currentId);

        el.selectedId.addEventListener('click', () => {
            handleChange(el.selectedId, el.actionsReplenishBtn);
        });
    }

})();




/*  

    // Set content height depending on current viewport
    function setContentHeight() {
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

    };
*/