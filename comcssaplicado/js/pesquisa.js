let search = document.getElementById('pesquisar');

search.addEventListener("keydown", function(event) {

    if (event.key === "Enter")
    {
        searchData();
    }

});

function searchData()
{
    window.location = 'paginatop.php?search=' + search.value;
}