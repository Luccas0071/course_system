export function requestFetch(url, method, body = null) {

    const token = localStorage.getItem('token');

    return fetch(url, {
        method: method,
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json',
        },
        body: body ? JSON.stringify(body) : null,
    })
        .then((response) => {
            return response.json()
        })
        .then((data) => {
            return data;
        })
        .catch((err) => {
            console.error('Error in requestFetch: ', err);
            throw err;
        });
}

export function message(data) {

    const notification = document.getElementById('notification');
    notification.innerHTML = '';

    if (data.success) {
        notification.classList.remove('error');
        notification.classList.add('sucess');
    } else {
        notification.classList.remove('sucess');
        notification.classList.add('error');
    }

    for (const message of data.message) {
        const paragraph = document.createElement('p');
        paragraph.textContent = message;
        notification.appendChild(paragraph);
    }
    // notification.innerText = data.message;
    notification.style.display = '';

    setTimeout(() => {
        notification.style.display = 'none';
    }, 3000);
}