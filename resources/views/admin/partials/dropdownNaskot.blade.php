<select id="items" name="items" data-placeholder="Pilih Isian" multiple data-multi-select>
    <!-- Predefined option -->
    <option value="Test">Test</option>
</select>

<!-- Include the Multi Select JS class -->
<script src="{{ asset('js/MultiSelect.js') }}"></script>

<!-- CSS for margin -->
<style>
    .multi-select-header-option {
        margin-right: 10px; /* Menambahkan margin kanan pada setiap item */
        margin-bottom: 4px; /* Menambahkan margin bawah pada setiap item */
    }
</style>
<script>
let selectedIds = []; // Define selectedIds array globally
let selectElement = document.getElementById("items");

document.addEventListener("DOMContentLoaded", function() {

    // Fetch data from the API and populate the select options
    fetch('/api/satuans')
        .then(response => response.json())
        .then(data => {
            // Add options to the select element
            data.forEach(item => {
                const option = document.createElement("option");
                option.value = item.id;
                option.textContent = item.nama;
                selectElement.appendChild(option);
            });

            // Initialize MultiSelect after populating the options
            const multiSelect = new MultiSelect(selectElement, {
                placeholder: 'Pilih Isian',
                onChange: function(value, text, option) {
                    console.log(value, text, option);
                }
            });

            // Call to set selected options if selectedIds is populated
        })
        .catch(error => {
            console.error("Error fetching data:", error);
        });

        

});
</script>
