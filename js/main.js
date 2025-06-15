// js/main.js – Update slot statuses every 5 seconds
setInterval(function() {
    fetch('get_slots.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('slot_table_body');
            tableBody.innerHTML = ''; // Clear existing rows

            data.forEach(slot => {
                // Create a new row
                const row = document.createElement('tr');
                row.id = 'slot-' + slot.id;

                // ID cell
                const cellId = document.createElement('td');
                cellId.textContent = slot.id;
                row.appendChild(cellId);

                // Slot Name cell
                const cellName = document.createElement('td');
                cellName.textContent = slot.slot_name;
                row.appendChild(cellName);

                // Status cell
                const cellStatus = document.createElement('td');
                if (slot.status == 0) {
                    cellStatus.innerHTML = '<span class="badge bg-success">Available</span>';
                } else {
                    cellStatus.innerHTML = '<span class="badge bg-danger">Booked</span>';
                }
                row.appendChild(cellStatus);

                // Action cell
                const cellAction = document.createElement('td');
                if (slot.status == 0) {
                    cellAction.innerHTML = '<a href="booking.php?id=' + slot.id +
                                           '" class="btn btn-primary btn-sm">Book Now</a>';
                } else {
                    cellAction.innerHTML = '<button class="btn btn-secondary btn-sm" disabled>Booked</button>';
                }
                row.appendChild(cellAction);

                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching slot data:', error));
}, 5000); // 5 seconds interval
