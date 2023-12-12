document.addEventListener('DOMContentLoaded', function() {
    var toggleButton = document.getElementById('toggleButton');
    var titleFuriganaOn = document.getElementById('titleFuriganaOn');
    var titleFuriganaOff = document.getElementById('titleFuriganaOff');
    var contentFuriganaOn = document.getElementById('contentFuriganaOn');
    var contentFuriganaOff = document.getElementById('contentFuriganaOff');
    var activeDot = document.getElementById('activeDot');
    var inactiveDot = document.getElementById('inactiveDot');

    toggleButton.addEventListener('click', function() {

        // If toggling a class is causing the resize, remove this class toggle
        activeDot.classList.toggle('resized-image');
        inactiveDot.classList.toggle('resized-image');

        // Toggle visibility of the dots
        if (activeDot.style.display === 'none') {
            activeDot.style.display = 'block';
            inactiveDot.style.display = 'none';
        } else {
            activeDot.style.display = 'none';
            inactiveDot.style.display = 'block';
        }

        console.log(status.textContent);

        var isFuriganaVisible = titleFuriganaOn.style.display !== 'none';

        titleFuriganaOn.style.display = isFuriganaVisible ? 'none' : 'block';
        titleFuriganaOff.style.display = isFuriganaVisible ? 'block' : 'none';
        contentFuriganaOn.style.display = isFuriganaVisible ? 'none' : 'block';
        contentFuriganaOff.style.display = isFuriganaVisible ? 'block' : 'none';

        activeDot.style.display = isFuriganaVisible ? 'none' : 'block';
        inactiveDot.style.display = isFuriganaVisible ? 'block' : 'none';
    });
});



// document.addEventListener('DOMContentLoaded', function() {
//     window.addEventListener('newsItemUpdated', function(event) {
//         var id = event.detail.id;
//         var statusElement = document.getElementById('status-' + id);
//         if (statusElement) {
//             statusElement.textContent = '✔既読';
//             localStorage.setItem('newsStatus-' + id, '既読');
//         }
//     });

//     // Set status on page load
//     var statusElements = document.querySelectorAll('[id^="status-"]');
//     statusElements.forEach(function(element) {
//         var id = element.id.split('-')[1];
//         if (localStorage.getItem('newsStatus-' + id) === '既読') {
//             element.textContent = '✔既読';
//         }
//     });
// });