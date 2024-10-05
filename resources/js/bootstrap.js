import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

new MultiSelectTag('countries', {
    rounded: true, // Keep rounded corners for modern look
    shadow: true,  // Add shadow for slight depth
    placeholder: 'Search...', // Minimal placeholder text
    tagColor: {
        textColor: '#ffffff',   // White text for good contrast
        borderColor: '#333333', // Dark gray border for subtle separation
        bgColor: '#000000',     // Black background for sleek design
    },
    maxWidth: '100%',  // Responsive width
    minWidth: '250px', // Ensure it doesn’t get too small
    responsive: true,  // Enable responsive behavior
    onChange: function(values) {
        console.log(values);
    }
});


  document.addEventListener('DOMContentLoaded', function () {
    var multiSelect = new coreui.MultiSelect(document.getElementById('ms1'));
  });




