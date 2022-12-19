// Make an HTTP GET request to the backend to retrieve the list of characters
async function getCharacters() {
    try {
        const response = await fetch('/');
        const characters = await response.json();
        return characters;
    } catch (error) {
        console.error(error);
    }
}

// Make an HTTP POST request to the backend to send the start round action
async function startRound(attackerId, defenderId) {
    try {
        const response = await fetch('/', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ attackerId, defenderId }),
        });
        const result = await response.json();
        return result;
    } catch (error) {
        console.error(error);
    }
}
