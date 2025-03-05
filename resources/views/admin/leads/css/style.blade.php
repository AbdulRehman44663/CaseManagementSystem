<style>
.my_table tbody tr {
    border: none !important; /* Remove border from rows */
}

.my_table {
    border-collapse: collapse; /* Ensure no gaps between table cells */
}

.my_table tbody td {
    border: none !important; /* Remove border from table cells */
}
table.dataTable.no-footer {
    border-bottom: unset;
}
.dataTables_paginate .paginate_button {
    padding: 5px 10px;  /* Adjust padding to make buttons smaller */
    font-size: 12px;     /* Reduce font size */
    height: 30px;        /* Adjust height */
}

/* Optional: Adjust active and hover states */
.dataTables_paginate .paginate_button:hover {
    background-color: #126C9B;  /* Highlight color on hover */
    color: white;
}

.dataTables_paginate .paginate_button.active {
    background-color: #126C9B;  /* Active button background */
    color: white;
}
</style>