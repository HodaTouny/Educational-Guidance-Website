function redirectTo(type) {
    if (type === 'login') {
        window.location.href = 'Authuntication.php?type=login';
    } else if (type === 'signup') {
        window.location.href = 'Authuntication.php?type=signup';
    }
}

function logout() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '', true); 
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            window.location.href = 'Home.php';
        }
    };
    xhr.send('action=logout');
}
