function searchTable() {
    var input, filter, table, tr, td, i, j, txtValue;

    input = document.getElementById("searchInput");
    filter = input.value.toLowerCase();
    table = document.getElementById("dataGrid");
    tr = table.getElementsByTagName("tr");


//Looping
for (i = 1; i < tr.length; i++) {//Starts at 1 to skip the header
    tr[i].style.display = "none"; //Hide all the rows initially
    td = tr[i].getElementsByTagName("td");
    for (j = 0; j < td.length; j++) {// loop through each cell
        if(td[j]) {
            txtValue = td[j].textContent || td[j].innerText;
            if(txtValue.toLowerCase().indexOf(filter) > -1){
                tr[i].style.display= ""; //show the row id a match is located
                break;
            }
        }
    }
}
}
