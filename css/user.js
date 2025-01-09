window.addEventListener('DOMContentLoaded', () => {
    const profileInfoElement = document.getElementById('profile-info');

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `dashboard.php?id=${encodeURIComponent(getQueryVariable('id'))}`);
    xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                profileInfoElement.innerHTML = xhr.responseText;
            } else {
                profileInfoElement.innerHTML = 'Error loading profile information.';
            }
        }
    };
    xhr.send();

    function getQueryVariable(variable) {
        const query = window.location.search.substring(1);
        const vars = query.split('&');
        for (let i = 0; i < vars.length; i++) {
            const pair = vars[i].split('=');
            if (decodeURIComponent(pair[0]) === variable) {
                return decodeURIComponent(pair[1]);
            }
        }
        return null;
    }
});
