(function () {
    var current = document.querySelector('.admin-nav a.active');
    if (current) {
        current.scrollIntoView({ block: 'nearest' });
    }
})();
