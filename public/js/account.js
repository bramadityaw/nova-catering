document.addEventListener("DOMContentLoaded", function() {
    const csvFilePath = 'adminAccount.csv'; // Path to your CSV file

    async function fetchCSVData() {
        const response = await fetch(csvFilePath);
        const data = await response.text();
        const rows = data.split('\n').slice(1); // Skip the header row
        let adminList = []; // Array to store the admin data

        rows.forEach(row => {
            // Trim the row to remove any leading or trailing whitespace
            row = row.trim();

            // Skip empty rows
            if (row === '') return;

            // Using regex to match CSV values correctly
            const columns = row.match(/(?:\"([^\"]*)\"|([^\",]+))/g);

            // Check if columns were found and have the correct length
            if (columns && columns.length === 2) { // Expecting two columns: username, password
                const admin = {
                    username: columns[0].replace(/\"/g, '').trim(),
                    password: columns[1].replace(/\"/g, '').trim()
                };
                adminList.push(admin);
            }
        });

        document.getElementById("totalAdmin").innerText = adminList.length; // Set total count
        displayAdminCards(adminList); // Display the cards
    }

    function displayAdminCards(adminList) {
        const articleContainer = document.querySelector('.article-container');
        articleContainer.innerHTML = ''; // Clear existing cards

        adminList.forEach((admin) => {
            const newAdminCard = document.createElement('div');
            newAdminCard.classList.add('card');

            newAdminCard.innerHTML = `
                <div class="card-title">
                    <p>Nama Admin</p>
                    <div class="title">
                        <p>${admin.username}</p>
                    </div>
                </div>

            `;

            articleContainer.appendChild(newAdminCard);
        });
    }

    fetchCSVData(); // Fetch CSV data on page load
});

