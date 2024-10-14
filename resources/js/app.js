import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.fade-in').forEach(element => {
        element.classList.add('fade-in');
    });
});

document.getElementById('screenshotButton').addEventListener('click', function () {
    // Select the element you want to capture
    var captureElement = document.getElementById('capture');

    // Use html2canvas to take a screenshot
    html2canvas(captureElement).then(canvas => {
        // Create an image from the canvas
        var imgData = canvas.toDataURL('image/png');

        // Create a link to download the image
        var link = document.createElement('a');
        link.href = imgData;
        link.download = 'screenshot.png';

        // Trigger the download
        link.click();
    }).catch(error => {
        console.error('Screenshot capture failed:', error);
    });
});
