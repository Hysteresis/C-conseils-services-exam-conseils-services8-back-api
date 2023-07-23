
 console.log('hello');
    const searchInput = document.querySelector("[data-search]");
    console.log('searchInput' + searchInput)
     console.log('hello');

    async function interrogerControleur(value) {
        try {
            const url = "https://localhost:8000";
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ value }),
                
            });
            console.log(value)
            if (!response.ok) {
                throw new Error('La requête a échoué.'); // Gérer les erreurs de requête
            } else {
                console.log(response)
            }

            const data = await response.json();

            console.log('response : ' + data); // Traiter la réponse JSON
        } catch (error) {
            console.error(error);
        }
    }

    searchInput.addEventListener('input', e => {
        const value = e.target.value;
        interrogerControleur(value);
    });

