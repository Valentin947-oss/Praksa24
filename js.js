
    document.addEventListener('DOMContentLoaded', function () {
        var checkbox = document.querySelector('#menu-toggle');
        checkbox.addEventListener('change', function () {
            var menu = document.querySelector('.menu');
            if (checkbox.checked) {
                menu.style.maxHeight = menu.scrollHeight + 'px';
            } else {
                menu.style.maxHeight = null;
            }
        });
    });
